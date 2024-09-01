@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Revenues</h2>
        </div>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-200">Product</th>
                <th class="py-2 px-4 bg-gray-200">Buyer Name</th>
                <th class="py-2 px-4 bg-gray-200">Total Price</th>
                <th class="py-2 px-4 bg-gray-200">Purchase Date</th>
                <th class="py-2 px-4 bg-gray-200">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($revenues as $revenue)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $revenue->purchase->product->name ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $revenue->purchase->name ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $revenue->purchase->total_price }}</td>
                    <td class="py-2 px-4 border-b">{{ $revenue->purchase->purchase_date }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('revenues.edit', $revenue->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('revenues.destroy', $revenue->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
