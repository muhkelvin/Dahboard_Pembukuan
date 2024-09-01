@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $product->name }}</h2>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Category:</h3>
            <p class="text-gray-600">{{ $product->category->name }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Description:</h3>
            <p class="text-gray-600">{{ $product->description }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Price:</h3>
            <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Stock:</h3>
            <p class="text-gray-600">{{ $product->stock }}</p>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('crud-products.edit', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</a>
            <form action="{{ route('crud-products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
            </form>
            <a href="{{ route('crud-products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Back</a>
        </div>
    </div>
@endsection
