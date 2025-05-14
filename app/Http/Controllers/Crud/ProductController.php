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
        $search = $request->get('search', '');
        $sort = $request->get('sort', 'name');
        $order = $request->get('order', 'asc');
        $category = $request->get('category', '');
        $stockStatus = $request->get('stock_status', '');

        $products = Product::with('category')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                });
            })
            ->when($category, function($query) use ($category) {
                $query->whereHas('category', function($q) use ($category) {
                    $q->where('id', $category);
                });
            })
            ->when($stockStatus, function($query) use ($stockStatus) {
                if ($stockStatus === 'low') {
                    $query->where('stock', '<', 10);
                } elseif ($stockStatus === 'out') {
                    $query->where('stock', 0);
                }
            })
            ->orderBy($sort, $order)
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->pluck('name', 'id');

        return view('crud.products.index', compact('products', 'categories'))
            ->with([
                'search' => $search,
                'sort' => $sort,
                'order' => $order,
                'selectedCategory' => $category,
                'selectedStockStatus' => $stockStatus
            ]);
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
