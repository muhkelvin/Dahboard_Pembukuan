@extends('layouts.app')

@section('content')
    <div class="max-w-[1800px] mx-auto px-[16px] sm:px-[24px] py-[32px]">
        <div class="mb-[24px] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-[16px]">
            <h1 class="text-[28px] font-[800] text-[#1f2937]">Financial Dashboard</h1>
            <div class="flex flex-col sm:flex-row gap-[12px]">
                <form action="{{ route('dashboard.index') }}" method="GET" class="flex flex-wrap gap-[12px]">
                    <div class="relative flex-1">
                        <select name="period" onchange="this.form.submit()"
                                class="w-full pl-[40px] pr-[32px] py-[10px] border border-[#e5e7eb] rounded-[8px] shadow-sm text-[14px] bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiM2YjcyODAiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS1jaGV2cm9uLWRvd24iPjxwYXRoIGQ9Im03IDE1IDUgNSA1LTUiLz48L3N2Zz4=')] bg-no-repeat bg-[12px_center]">
                            <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Today</option>
                            <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>This Week</option>
                            <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>This Month</option>
                            <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>This Year</option>
                            <option value="all" {{ request('period') == 'all' ? 'selected' : '' }}>All Time</option>
                        </select>
                    </div>
                    <a href="{{ route('dashboard.downloadPDF', ['period' => request('period', 'monthly')]) }}"
                       class="flex items-center gap-[8px] px-[16px] py-[10px] bg-white border border-[#e5e7eb] hover:bg-[#f3f4f6] text-[#374151] rounded-[8px] text-[14px] font-[600]">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"></path>
                        </svg>
                        Export PDF
                    </a>
                </form>
            </div>
        </div>

        <!-- Key Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[16px] mb-[32px]">
            <!-- Revenue Card -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] border-l-[4px] border-[#10b981]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[14px] text-[#6b7280] mb-[8px]">Total Revenue</p>
                        <p class="text-[24px] font-[700] text-[#1f2937]">Rp {{ number_format($totalRevenues, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-[#d1fae5] p-[8px] rounded-[8px]">
                        <svg class="w-[20px] h-[20px] text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Purchases Card -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] border-l-[4px] border-[#ef4444]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[14px] text-[#6b7280] mb-[8px]">Pending Payments</p>
                        <p class="text-[24px] font-[700] text-[#1f2937]">Rp {{ number_format($totalPendingPurchases, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-[#fee2e2] p-[8px] rounded-[8px]">
                        <svg class="w-[20px] h-[20px] text-[#dc2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Profit Card -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] border-l-[4px] border-[#8b5cf6]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[14px] text-[#6b7280] mb-[8px]">Net Profit</p>
                        <p class="text-[24px] font-[700] text-[#1f2937]">Rp {{ number_format($profit, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-[#ede9fe] p-[8px] rounded-[8px]">
                        <svg class="w-[20px] h-[20px] text-[#7c3aed]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Products Purchased Card -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] border-l-[4px] border-[#3b82f6]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[14px] text-[#6b7280] mb-[8px]">Products Sold</p>
                        <p class="text-[24px] font-[700] text-[#1f2937]">{{ number_format($totalProductsPurchased, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-[#dbeafe] p-[8px] rounded-[8px]">
                        <svg class="w-[20px] h-[20px] text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-[24px] mb-[32px]">
            <!-- Financial Overview Chart -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)]">
                <h3 class="text-[18px] font-[700] mb-[24px]">Financial Overview</h3>
                <div class="h-[300px]">
                    <canvas id="financeChart"></canvas>
                </div>
            </div>

            <!-- Top Products Chart -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)]">
                <h3 class="text-[18px] font-[700] mb-[24px]">Top Selling Products</h3>
                <div class="h-[300px]">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Additional Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[24px]">
            <!-- Expense Card -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)]">
                <div class="flex justify-between items-center mb-[16px]">
                    <h4 class="text-[16px] font-[600]">Total Expenses</h4>
                    <div class="bg-[#fef3c7] p-[8px] rounded-[8px]">
                        <svg class="w-[20px] h-[20px] text-[#d97706]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-[28px] font-[700] text-[#1f2937]">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
                <div class="mt-[16px] pt-[16px] border-t border-[#e5e7eb]">
                    <p class="text-[14px] text-[#6b7280]">
                        <span class="font-[500]">{{ $totalRevenues ? number_format(($totalExpenses / $totalRevenues) * 100, 1) : 0 }}%</span> of total revenue
                    </p>
                </div>
            </div>

            <!-- Purchase Efficiency -->
            <div class="bg-white p-[24px] rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.1)]">
                <div class="flex justify-between items-center mb-[16px]">
                    <h4 class="text-[16px] font-[600]">Purchase Efficiency</h4>
                    <div class="bg-[#dcfce7] p-[8px] rounded-[8px]">
                        <svg class="w-[20px] h-[20px] text-[#16a34a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-end gap-[16px]">
                    <p class="text-[28px] font-[700] text-[#1f2937]">
                        {{ $totalProductsPurchased > 0 ? number_format($totalRevenues/$totalProductsPurchased, 0, ',', '.') : 0 }}
                    </p>
                    <span class="text-[14px] text-[#6b7280] mb-[6px]">IDR per product</span>
                </div>
                <div class="mt-[16px] pt-[16px] border-t border-[#e5e7eb]">
                    <p class="text-[14px] text-[#6b7280]">
                        <span class="font-[500]">{{ $totalPendingPurchases > 0 ? number_format($totalPendingPurchases/$totalPurchases*100, 1) : 0 }}%</span> pending payments
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Financial Chart
            const financeCtx = document.getElementById('financeChart').getContext('2d');
            new Chart(financeCtx, {
                type: 'bar',
                data: {
                    labels: ['Revenue', 'Purchases', 'Expenses'],
                    datasets: [{
                        label: 'Amount (Rp)',
                        data: [{{ $totalRevenues }}, {{ $totalPurchases }}, {{ $totalExpenses }}],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.1)',
                            'rgba(59, 130, 246, 0.1)',
                            'rgba(239, 68, 68, 0.1)'
                        ],
                        borderColor: [
                            '#10b981',
                            '#3b82f6',
                            '#ef4444'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e5e7eb' },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp' + (value / 1e6).toFixed(1) + 'M';
                                }
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.raw.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // Top Products Chart
            const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
            new Chart(topProductsCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($topSellingProducts->pluck('product.name')) !!},
                    datasets: [{
                        data: {!! json_encode($topSellingProducts->pluck('total_quantity')) !!},
                        backgroundColor: [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#6366f1',
                            '#ef4444'
                        ].map(c => c + '33'),
                        borderColor: [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#6366f1',
                            '#ef4444'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'right' },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.raw + ' units';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
