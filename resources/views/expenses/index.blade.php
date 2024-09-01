@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Expenses</h2>
            <a href="{{ route('expenses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Expense
            </a>
        </div>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-200">Description</th>
                <th class="py-2 px-4 bg-gray-200">Amount</th>
                <th class="py-2 px-4 bg-gray-200">Date</th>
                <th class="py-2 px-4 bg-gray-200">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $expense->description }}</td>
                    <td class="py-2 px-4 border-b">{{ $expense->amount }}</td>
                    <td class="py-2 px-4 border-b">{{ $expense->expense_date }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline-block">
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
