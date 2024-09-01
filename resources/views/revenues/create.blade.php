@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Add New Revenue</h2>
        <form action="{{ route('revenues.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <input type="text" name="description" id="description" class="w-full border-gray-300 rounded-lg" value="{{ old('description') }}" required>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount" class="w-full border-gray-300 rounded-lg" value="{{ old('amount') }}" required>
            </div>
            <div class="mb-4">
                <label for="revenue_date" class="block text-gray-700">Date</label>
                <input type="date" name="revenue_date" id="revenue_date" class="w-full border-gray-300 rounded-lg" value="{{ old('revenue_date') }}" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Revenue</button>
        </form>
    </div>
@endsection
