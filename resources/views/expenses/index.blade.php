@extends('layouts.app')

@section('content')
    <div class="max-w-[1400px] mx-auto px-[16px] sm:px-[24px] py-[32px]">
        <div class="bg-white rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden">
            <!-- Header Section -->
            <div class="px-[24px] py-[16px] border-b border-[#e5e7eb] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-[16px]">
                <div>
                    <h1 class="text-[24px] font-[700] text-[#1f2937]">Expense Management</h1>
                    <p class="mt-[4px] text-[14px] text-[#4b5563]">
                        Showing {{ $expenses->firstItem() }} - {{ $expenses->lastItem() }} of {{ $expenses->total() }} expenses
                    </p>
                </div>
                <a href="{{ route('expenses.create') }}"
                   class="inline-flex items-center px-[16px] py-[8px] bg-[#2563eb] hover:bg-[#1d4ed8] text-white rounded-[6px] transition-colors duration-[200ms] text-[14px] font-[600] gap-[8px]">
                    <svg class="w-[20px] h-[20px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Expense
                </a>
            </div>

            <!-- Filters Section -->
            <div class="px-[24px] py-[16px] border-b border-[#e5e7eb] bg-[#f9fafb]">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-[16px]">
                    <div>
                        <input type="text" name="search" placeholder="Search description..."
                               value="{{ request('search') }}"
                               class="w-full px-[12px] py-[8px] border border-[#e5e7eb] rounded-[6px] shadow-sm focus:ring-[2px] focus:ring-[#2563eb] text-[14px]">
                    </div>

                    <div class="flex gap-[8px]">
                        <input type="date" name="start_date"
                               value="{{ request('start_date') }}"
                               class="w-full px-[12px] py-[8px] border border-[#e5e7eb] rounded-[6px] shadow-sm text-[14px]">
                        <input type="date" name="end_date"
                               value="{{ request('end_date') }}"
                               class="w-full px-[12px] py-[8px] border border-[#e5e7eb] rounded-[6px] shadow-sm text-[14px]">
                    </div>

                    <div>
                        <select name="per_page" onchange="this.form.submit()"
                                class="w-full px-[12px] py-[8px] border border-[#e5e7eb] rounded-[6px] shadow-sm text-[14px]">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                        </select>
                    </div>

                    <div class="flex gap-[8px]">
                        <button type="submit"
                                class="px-[16px] py-[8px] bg-[#2563eb] hover:bg-[#1d4ed8] text-white rounded-[6px] text-[14px] font-[600]">
                            Apply
                        </button>
                        <a href="{{ route('expenses.index') }}"
                           class="px-[16px] py-[8px] bg-white border border-[#e5e7eb] hover:bg-[#f3f4f6] text-[#374151] rounded-[6px] text-[14px] font-[600]">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-[#e5e7eb]">
                    <thead class="bg-[#f9fafb]">
                    <tr>
                        <th class="px-[16px] py-[12px] text-left text-[12px] font-[500] text-[#6b7280] uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-[16px] py-[12px] text-right text-[12px] font-[500] text-[#6b7280] uppercase tracking-wider">
                            Amount
                        </th>
                        <th class="px-[16px] py-[12px] text-left text-[12px] font-[500] text-[#6b7280] uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-[16px] py-[12px] text-right text-[12px] font-[500] text-[#6b7280] uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e5e7eb]">
                    @forelse($expenses as $expense)
                        <tr class="hover:bg-[#f9fafb] transition-colors">
                            <td class="px-[16px] py-[16px] text-[14px] text-[#1f2937] max-w-[300px] truncate">
                                {{ $expense->description }}
                            </td>
                            <td class="px-[16px] py-[16px] text-[14px] text-[#1f2937] text-right font-mono">
                                RP{{ number_format($expense->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-[16px] py-[16px] text-[14px] text-[#6b7280]">
                                {{ $expense->expense_date->format('d M Y') }}
                            </td>
                            <td class="px-[16px] py-[16px] text-right space-x-[8px]">
                                <a href="{{ route('expenses.edit', $expense->id) }}"
                                   class="inline-block p-[8px] text-[#2563eb] hover:bg-[#bfdbfe] rounded-full transition-colors">
                                    <svg class="w-[20px] h-[20px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </a>

                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-[8px] text-[#dc2626] hover:bg-[#fecaca] rounded-full transition-colors"
                                            onclick="return confirm('Delete this expense?')">
                                        <svg class="w-[20px] h-[20px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-[24px] py-[32px] text-center text-[#6b7280]">
                                <div class="mb-[16px]">
                                    <svg class="mx-auto w-[48px] h-[48px] text-[#9ca3af]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                No expenses found matching your criteria
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($expenses->hasPages())
                <div class="px-[24px] py-[16px] border-t border-[#e5e7eb] bg-[#f9fafb]">
                    <div class="flex justify-center gap-[8px]">
                        @if ($expenses->onFirstPage())
                            <span class="px-[12px] py-[6px] text-[#9ca3af] cursor-not-allowed">&laquo;</span>
                        @else
                            <a href="{{ $expenses->previousPageUrl() }}" class="px-[12px] py-[6px] text-[#2563eb] hover:bg-[#bfdbfe] rounded-[4px]">&laquo;</a>
                        @endif

                        @foreach ($expenses->getUrlRange(1, $expenses->lastPage()) as $page => $url)
                            @if ($page == $expenses->currentPage())
                                <span class="px-[12px] py-[6px] bg-[#2563eb] text-white rounded-[4px]">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-[12px] py-[6px] text-[#2563eb] hover:bg-[#bfdbfe] rounded-[4px]">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($expenses->hasMorePages())
                            <a href="{{ $expenses->nextPageUrl() }}" class="px-[12px] py-[6px] text-[#2563eb] hover:bg-[#bfdbfe] rounded-[4px]">&raquo;</a>
                        @else
                            <span class="px-[12px] py-[6px] text-[#9ca3af] cursor-not-allowed">&raquo;</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
