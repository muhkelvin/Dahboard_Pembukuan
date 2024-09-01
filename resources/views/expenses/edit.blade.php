@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Expense</h2>
        <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <input type="text" name="description" id="description" class="w-full border-gray-300 rounded-lg" value="{{ old('description', $expense->description) }}" required>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount" class="w-full border-gray-300 rounded-lg" value="{{ old('amount', $expense->amount) }}" required>
            </div>
            <div class="mb-4">
                <label for="expense_date" class="block text-gray-700">Date</label>
                <input type="date" name="expense_date" id="expense_date" class="w-full border-gray-300 rounded-lg" value="{{ old('expense_date', $expense->expense_date) }}" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Expense</button>
        </form>
    </div>
@endsection
