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
        $period = $request->query('period', 'monthly');

        // Sama seperti pada method index, tentukan rentang tanggal atau 'all'
        if ($period === 'all') {
            $purchases = Purchase::all();
            $expenses = Expense::all();
            $revenues = Revenue::all();
        } else {
            $startDate = match ($period) {
                'weekly' => Carbon::now()->subWeek(),
                'monthly' => Carbon::now()->subMonth(),
                'yearly' => Carbon::now()->subYear(),
                default => Carbon::now()->subMonth(),
            };

            $purchases = Purchase::where('purchase_date', '>=', $startDate)->get();
            $expenses = Expense::where('expense_date', '>=', $startDate)->get();
            $revenues = Revenue::where('revenue_date', '>=', $startDate)->get();
        }

        $totalPurchases = $purchases->sum('total_price');
        $totalExpenses = $expenses->sum('amount');
        $totalRevenues = $revenues->sum('amount');
        $profit = $totalRevenues - $totalExpenses;

        $pdf = Pdf::loadView('dashboard.pdf', compact('totalPurchases', 'totalExpenses', 'totalRevenues', 'profit', 'period'));
        return $pdf->download('dashboard_report.pdf');
    }
}

