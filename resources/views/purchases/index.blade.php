@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Purchases</h1>
        <a href="{{ route('purchases.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add Purchase</a>

        <table class="min-w-full bg-white border">
            <thead>
            <tr>
                <th class="px-6 py-3 border-b-2">Product</th>
                <th class="px-6 py-3 border-b-2">Name</th>
                <th class="px-6 py-3 border-b-2">Quantity</th>
                <th class="px-6 py-3 border-b-2">Total Price</th>
                <th class="px-6 py-3 border-b-2">Purchase Date</th>
                <th class="px-6 py-3 border-b-2">Payment Status</th>
                <th class="px-6 py-3 border-b-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td class="px-6 py-4 border-b">{{ $purchase->product->name }}</td>
                    <td class="px-6 py-4 border-b">{{ $purchase->name }}</td>
                    <td class="px-6 py-4 border-b">{{ $purchase->quantity }}</td>
                    <td class="px-6 py-4 border-b">{{ 'RP.' . number_format($purchase->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 border-b">{{ $purchase->purchase_date}}</td>
                    <td class="px-6 py-4 border-b">
                        @if($purchase->payment_status == 'Lunas')
                            <span class="text-green-600 font-semibold">Paid</span>
                        @else
                            <span class="text-red-600 font-semibold">Not paid</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 border-b">
                        <div class="flex space-x-2">
                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
