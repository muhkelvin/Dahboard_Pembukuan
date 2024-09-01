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
        $purchases = Purchase::with('product')->get();
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
            'name' => 'required|string|max:255',
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
