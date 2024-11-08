<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->get('order', 'asc'); // Default order A-Z (ascending)
        $search = $request->get('search', ''); // Default search query is empty

        $products = Product::with('category')
            ->where('name', 'like', '%' . $search . '%')
            ->orderBy('name', $order)
            ->paginate(10); // Menambahkan paginasi dengan 10 item per halaman

        return view('crud.products.index', compact('products', 'order', 'search'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('crud.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);
        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('crud.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('crud.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);
        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
