@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Expense Details</h2>
        <p><strong>Description:</strong> {{ $expense->description }}</p>
        <p><strong>Amount:</strong> {{ $expense->amount }}</p>
        <p><strong>Date:</strong> {{ $expense->expense_date }}</p>
        <a href="{{ route('expenses.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Expenses</a>
    </div>
@endsection
