@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <!-- Filter Period -->
        <div class="mb-4">
            <form action="{{ route('dashboard.index') }}" method="GET" class="flex space-x-4">
                <select name="period" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                    <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                    <option value="all" {{ request('period') == 'all' ? 'selected' : '' }}>All Time</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h5 class="text-lg font-semibold">Total Pembelian</h5>
                <p class="text-2xl text-gray-700">Rp {{ number_format($totalPurchases, 2) }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h5 class="text-lg font-semibold text-red-500">Total Pembelian Belum Lunas</h5>
                <p class="text-2xl text-red-600">Rp {{ number_format($totalPendingPurchases, 2) }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h5 class="text-lg font-semibold text-blue-500">Total Pendapatan</h5>
                <p class="text-2xl text-blue-600">Rp {{ number_format($totalRevenues, 2) }}</p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h5 class="text-lg font-semibold mb-4 text-green-500">Profit</h5>
            <p class="text-2xl text-green-600">Rp {{ number_format($profit, 2) }}</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h5 class="text-lg font-semibold mb-4">Total Produk Terbeli</h5>
            <p class="text-2xl text-gray-700">{{ $totalProductsPurchased }} produk</p>
        </div>


        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h5 class="text-lg font-semibold mb-4">Top 5 Produk Terlaris</h5>
            <ul>
                @foreach($topSellingProducts as $item)
                    <li class="mb-2">
                        {{ $item['product']->name }}: {{ $item['total_quantity'] }} pcs
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h5 class="text-lg font-semibold mb-4">Grafik Pembelian, Pengeluaran, dan Pendapatan</h5>
            <canvas id="dashboardChart" width="400" height="200"></canvas>
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard.downloadPDF', ['period' => request('period', 'monthly')]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Download PDF
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('dashboardChart').getContext('2d');
            const dashboardChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Pembelian', 'Pengeluaran', 'Pendapatan'],
                    datasets: [{
                        label: 'Total (Rp)',
                        data: [{{ $totalPurchases }}, {{ $totalExpenses }}, {{ $totalRevenues }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)', // Pembelian
                            'rgba(54, 162, 235, 0.2)', // Pengeluaran
                            'rgba(75, 192, 192, 0.2)'  // Pendapatan
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)', // Pembelian
                            'rgba(54, 162, 235, 1)', // Pengeluaran
                            'rgba(75, 192, 192, 1)'  // Pendapatan
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
        });
    </script>
@endsection
