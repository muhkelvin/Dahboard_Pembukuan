@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Product List</h1>
            <div class="flex items-center">
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari Produk..." class="border border-gray-300 rounded px-4 py-2 mr-2">
                    <button type="submit" class="bg-gray-300 text-black px-4 py-2 rounded">Search</button>
                </form>
                <a href="{{ route('products.index', ['order' => 'asc', 'search' => $search]) }}" class="bg-gray-300 text-black px-4 py-2 rounded ml-2">A-Z</a>
                <a href="{{ route('products.index', ['order' => 'desc', 'search' => $search]) }}" class="bg-gray-300 text-black px-4 py-2 rounded ml-2">Z-A</a>
                <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded ml-4">Add Product</a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @if($products->isEmpty())
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Product not found.</td>
                    </tr>
                @else
                    @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ 'RP.' . number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        <div class="mt-4">
            {{ $products->links() }} <!-- Menampilkan tautan navigasi paginasi -->
        </div>
    </div>
@endsection
