<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::query()
            ->when(request('search'), function($query) {
                $query->where('description', 'LIKE', '%'.request('search').'%');
            })
            ->when(request('start_date'), function($query) {
                $query->whereDate('expense_date', '>=', request('start_date'));
            })
            ->when(request('end_date'), function($query) {
                $query->whereDate('expense_date', '<=', request('end_date'));
            })
            ->orderBy(request('sort_by', 'expense_date'), request('sort_dir', 'desc'))
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        Expense::create($validated);
        return redirect()->route('expenses.index');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        $expense->update($validated);
        return redirect()->route('expenses.index');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index');
    }
}
