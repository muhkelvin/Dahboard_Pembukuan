<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Revenue;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil periode dari query parameter, default ke 'monthly'
        $period = $request->query('period', 'monthly');

        // Tentukan rentang tanggal berdasarkan periode, dan handle 'all' untuk semua data
        $startDate = match ($period) {
            'weekly' => Carbon::now()->subWeek(),
            'monthly' => Carbon::now()->subMonth(),
            'yearly' => Carbon::now()->subYear(),
            'all' => null,
            default => Carbon::now()->subMonth(),
        };

        // Query data berdasarkan rentang tanggal
        $purchases = Purchase::when($startDate, function ($query) use ($startDate) {
            return $query->where('purchase_date', '>=', $startDate);
        })->get();

        $expenses = Expense::when($startDate, function ($query) use ($startDate) {
            return $query->where('expense_date', '>=', $startDate);
        })->get();

        // Menghitung total pembelian yang sudah dibayar (status 'Lunas')
        $totalPurchases = $purchases->sum('total_price');
        $totalExpenses = $expenses->sum('amount');

        // Total Pembelian yang Belum Lunas
        $totalPendingPurchases = Purchase::where('payment_status', 'Belum Lunas')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->where('purchase_date', '>=', $startDate);
            })->sum('total_price');

        // Dapatkan ID pembelian dari pembelian yang sudah dibayar
        $revenuePurchaseIds = Purchase::whereIn('id', $purchases->pluck('id'))
            ->where('payment_status', 'Lunas')
            ->pluck('id');

        // Hitung total pendapatan berdasarkan ID pembelian yang sudah dibayar
        $totalRevenues = Purchase::whereIn('id', $revenuePurchaseIds)
            ->sum('total_price');

        $profit = $totalRevenues - $totalExpenses;

        // Hitung total produk yang dibeli
        $totalProductsPurchased = $purchases->sum('quantity');

        // Ambil 5 produk yang paling laku
        $topSellingProducts = Purchase::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($purchase) {
                $product = Product::find($purchase->product_id);
                return [
                    'product' => $product,
                    'total_quantity' => $purchase->total_quantity,
                ];
            });

        return view('dashboard.index', compact('totalPurchases', 'totalPendingPurchases', 'totalExpenses', 'totalRevenues', 'profit', 'topSellingProducts', 'period','totalProductsPurchased'));
    }



    public function downloadPDF(Request $request)
    {
        try {

            $period = $request->query('period', 'monthly');
            $now = Carbon::now();

            $dateRanges = [
                'daily' => [
                    'start' => $now->copy()->startOfDay(),
                    'end' => $now->copy()->endOfDay(),
                    'label' => __('Hari Ini')
                ],
                'weekly' => [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek(),
                    'label' => __('Minggu Ini')
                ],
                'monthly' => [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth(),
                    'label' => __('Bulan Ini')
                ],
                'yearly' => [
                    'start' => $now->copy()->startOfYear(),
                    'end' => $now->copy()->endOfYear(),
                    'label' => __('Tahun Ini')
                ],
                'all' => [
                    'start' => null,
                    'end' => null,
                    'label' => __('Semua Waktu')
                ]
            ];

            $range = $dateRanges[$period] ?? $dateRanges['monthly'];

            // Query data dengan eager loading
            $purchases = Purchase::with('product')
                ->when($range['start'], function ($query) use ($range) {
                    return $query->whereBetween('purchase_date', [$range['start'], $range['end']]);
                })
                ->get();

            $expenses = Expense::when($range['start'], function ($query) use ($range) {
                return $query->whereBetween('expense_date', [$range['start'], $range['end']]);
            })
                ->get();

            // Hitung metrics
            $metrics = $this->calculateMetrics($purchases, $expenses);

            $pdf = PDF::loadView('dashboard.pdf', array_merge($metrics, [
                'periodLabel' => $range['label'],
                'generatedAt' => $now->format('d-m-Y H:i:s'),
                'dateRange' => $range['start']
                    ? $range['start']->format('d M Y') . ' - ' . $range['end']->format('d M Y')
                    : __('Semua Data')
            ]));

            return $pdf->download('financial-report-'.$now->format('Ymd-His').'.pdf');

        } catch (\Exception $e) {
            Log::error('PDF Generation Error: '.$e->getMessage());
            return back()->with('error', __('Gagal membuat laporan. Silakan coba lagi.'));
        }
    }

    private function calculateMetrics($purchases, $expenses)
    {
        $totalPurchases = $purchases->sum('total_price');
        $totalExpenses = $expenses->sum('amount');
        $totalRevenues = $purchases->where('payment_status', 'Lunas')->sum('total_price');

        return [
            'totalPurchases' => $totalPurchases,
            'totalPendingPurchases' => $purchases->where('payment_status', 'Belum Lunas')->sum('total_price'),
            'totalExpenses' => $totalExpenses,
            'totalRevenues' => $totalRevenues,
            'profit' => $totalRevenues - $totalExpenses,
            'totalProductsPurchased' => $purchases->sum('quantity'),
            'expensePercentage' => $totalRevenues ? ($totalExpenses / $totalRevenues) * 100 : 0,
            'topSellingProducts' => $purchases->groupBy('product_id')
                ->map(function ($group) {
                    return [
                        'product' => $group->first()->product,
                        'total_quantity' => $group->sum('quantity')
                    ];
                })
                ->sortByDesc('total_quantity')
                ->take(5)
                ->values()
        ];
    }
}

