<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        $revenues = Revenue::with(['purchase.product'])
            ->when(request('search'), function($query) {
                $query->whereHas('purchase', function($q) {
                    $q->where('name', 'like', '%'.request('search').'%')
                        ->orWhereHas('product', function($q) {
                            $q->where('name', 'like', '%'.request('search').'%');
                        });
                });
            })
            ->when(request('start_date'), function($query) {
                $query->whereDate('created_at', '>=', request('start_date'));
            })
            ->when(request('end_date'), function($query) {
                $query->whereDate('created_at', '<=', request('end_date'));
            })
            ->orderBy(request('sort_by', 'created_at'), request('sort_dir', 'desc'))
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('revenues.index', compact('revenues'));
    }


    public function create()
    {
        return view('revenues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'revenue_date' => 'required|date',
        ]);

        Revenue::create($validated);
        return redirect()->route('revenues.index');
    }

    public function show(Revenue $revenue)
    {
        return view('revenues.show', compact('revenue'));
    }

    public function edit(Revenue $revenue)
    {
        return view('revenues.edit', compact('revenue'));
    }

    public function update(Request $request, Revenue $revenue)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'revenue_date' => 'required|date',
        ]);

        $revenue->update($validated);
        return redirect()->route('revenues.index');
    }

    public function destroy(Revenue $revenue)
    {
        $revenue->delete();
        return redirect()->route('revenues.index');
    }
}
