<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Revenue;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['product.category'])
            ->when(request('search'), function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%'.request('search').'%')
                        ->orWhereHas('product', function($q) {
                            $q->where('name', 'like', '%'.request('search').'%');
                        });
                });
            })
            ->when(request('status'), function($query) {
                $query->where('payment_status', request('status'));
            })
            ->when(request('start_date'), function($query) {
                $query->whereDate('purchase_date', '>=', request('start_date'));
            })
            ->when(request('end_date'), function($query) {
                $query->whereDate('purchase_date', '<=', request('end_date'));
            })
            ->orderBy(request('sort_by', 'purchase_date'), request('sort_dir', 'desc'))
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'nullable|string|max:255',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
            'purchase_date' => 'required|date',
            'payment_status' => 'required|string|in:Lunas,Belum Lunas',
        ]);

        try {
            $product = Product::findOrFail($validated['product_id']);
            $pricePerUnit = $product->price;
            $quantity = (int) $validated['quantity'];

            $calculatedTotalPrice = $pricePerUnit * $quantity;

            $validated['total_price'] = floatval($calculatedTotalPrice);

            // Simpan purchase terlebih dahulu
            $purchase = Purchase::create($validated);

            // Jika status pembayaran "Lunas", masukkan ke tabel revenues
            if ($purchase->payment_status === 'Lunas') {
                Revenue::create([
                    'purchase_id' => $purchase->id,
                ]);
            }

            return redirect()->route('purchases.index')->with('success', 'Purchase saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error saving purchase: ' . $e->getMessage()])->withInput();
        }
    }






    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        return view('purchases.edit', compact('purchase', 'products'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
            'purchase_date' => 'required|date',
            'payment_status' => 'required|string|in:Lunas,Belum Lunas',
        ]);

        $purchase->update($validated);
        return redirect()->route('purchases.index');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index');
    }
}
