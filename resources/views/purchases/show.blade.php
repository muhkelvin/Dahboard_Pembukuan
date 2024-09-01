@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Purchase Details</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <strong class="text-gray-700">Product:</strong>
                <p class="text-gray-900">{{ $purchase->product->name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Name:</strong>
                <p class="text-gray-900">{{ $purchase->name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Quantity:</strong>
                <p class="text-gray-900">{{ $purchase->quantity }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Total Price:</strong>
                <p class="text-gray-900">{{ $purchase->total_price }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Purchase Date:</strong>
                <p class="text-gray-900">{{ $purchase->purchase_date }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Payment Status:</strong>
                <p class="text-gray-900">{{ $purchase->payment_status }}</p>
            </div>

            <a href="{{ route('purchases.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
        </div>
    </div>
@endsection
