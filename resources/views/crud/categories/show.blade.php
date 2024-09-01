@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $category->name }}</h2>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Description:</h3>
            <p class="text-gray-600">{{ $category->description }}</p>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('crud.categories.edit', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</a>
            <form action="{{ route('crud.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
            </form>
            <a href="{{ route('crud.categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Back</a>
        </div>
    </div>
@endsection
