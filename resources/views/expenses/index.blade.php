@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Expenses</h2>
            <a href="{{ route('expenses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Expense
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 text-left font-medium uppercase text-sm">Description</th>
                    <th class="py-3 px-4 text-left font-medium uppercase text-sm">Amount</th>
                    <th class="py-3 px-4 text-left font-medium uppercase text-sm">Date</th>
                    <th class="py-3 px-4 text-left font-medium uppercase text-sm">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($expenses as $expense)
                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-4 text-gray-700">{{ $expense->description }}</td>
                        <td class="py-4 px-4 text-gray-700">{{ 'RP.' . number_format($expense->amount, 0, ',', '.') }}</td>
                        <td class="py-4 px-4 text-gray-700">{{ $expense->expense_date }}</td>
                        <td class="py-4 px-4 flex items-center">
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="text-blue-500 hover:text-blue-700 mr-4">Edit</a>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
