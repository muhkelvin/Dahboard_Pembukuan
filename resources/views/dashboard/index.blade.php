@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Dashboard Keuangan</h1>

        <!-- Filter Period -->
        <div class="mb-6">
            <form action="{{ route('dashboard.index') }}" method="GET" class="flex flex-wrap items-center space-x-4">
                <select name="period" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Tahun Ini</option>
                    <option value="all" {{ request('period') == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
                <a href="{{ route('dashboard.downloadPDF', ['period' => request('period', 'monthly')]) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2">
                    Download PDF
                </a>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Pendapatan</h5>
                <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalRevenues, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Pembelian</h5>
                <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($totalPurchases, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Pembelian Belum Lunas</h5>
                <p class="text-3xl font-bold text-red-600">Rp {{ number_format($totalPendingPurchases, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Profit</h5>
                <p class="text-3xl font-bold text-purple-600">Rp {{ number_format($profit, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-4">Grafik Keuangan</h5>
                <canvas id="financeChart" width="400" height="200"></canvas>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-4">Top 5 Produk Terlaris</h5>
                <canvas id="topProductsChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-4">Total Pengeluaran</h5>
                <p class="text-2xl font-bold text-gray-700">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-4">Total Produk Terbeli</h5>
                <p class="text-2xl font-bold text-gray-700">{{ number_format($totalProductsPurchased, 0, ',', '.') }} produk</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Finance Chart
            const ctxFinance = document.getElementById('financeChart').getContext('2d');
            new Chart(ctxFinance, {
                type: 'bar',
                data: {
                    labels: ['Pendapatan', 'Pembelian', 'Pengeluaran'],
                    datasets: [{
                        label: 'Total (Rp)',
                        data: [{{ $totalRevenues }}, {{ $totalPurchases }}, {{ $totalExpenses }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Top Products Chart
            const ctxTopProducts = document.getElementById('topProductsChart').getContext('2d');
            new Chart(ctxTopProducts, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($topSellingProducts->pluck('product.name')) !!},
                    datasets: [{
                        data: {!! json_encode($topSellingProducts->pluck('total_quantity')) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Top 5 Produk Terlaris'
                        }
                    }
                }
            });
        });
    </script>
@endsection
