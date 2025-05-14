<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Laporan Keuangan') }} - {{ config('app.name') }}</title>
    <style>
        /* Modern PDF Styling */
        :root {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #1a202c;
        }

        .header {
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .logo {
            height: 50px;
            margin-bottom: 1rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 0.5rem;
            border-left: 4px solid;
        }

        .card-danger { border-color: #ef4444; }
        .card-success { border-color: #10b981; }
        .card-primary { border-color: #3b82f6; }
        .card-warning { border-color: #f59e0b; }

        .metric-label {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .metric-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .negative { color: #dc2626; }
        .positive { color: #16a34a; }

        .chart-section {
            margin: 2rem 0;
            page-break-inside: avoid;
        }

        .footer {
            margin-top: 3rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            font-size: 0.75rem;
            color: #64748b;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #f8fafc;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ storage_path('app/public/logo.png') }}" class="logo" alt="Company Logo">
    <h1>{{ __('Laporan Keuangan') }}</h1>
    <div class="text-sm text-gray-500">
        {{ __('Periode') }}: {{ $dateRange }}
    </div>
</div>

<div class="grid">
    <div class="card card-success">
        <div class="metric-label">{{ __('Total Pendapatan') }}</div>
        <div class="metric-value positive">
            Rp {{ number_format($totalRevenues, 0, ',', '.') }}
        </div>
    </div>

    <div class="card card-primary">
        <div class="metric-label">{{ __('Total Pembelian') }}</div>
        <div class="metric-value">
            Rp {{ number_format($totalPurchases, 0, ',', '.') }}
        </div>
    </div>

    <div class="card card-danger">
        <div class="metric-label">{{ __('Pembelian Belum Lunas') }}</div>
        <div class="metric-value negative">
            Rp {{ number_format($totalPendingPurchases, 0, ',', '.') }}
        </div>
    </div>

    <div class="card card-warning">
        <div class="metric-label">{{ __('Profit Bersih') }}</div>
        <div class="metric-value {{ $profit < 0 ? 'negative' : 'positive' }}">
            Rp {{ number_format($profit, 0, ',', '.') }}
        </div>
    </div>
</div>

<div class="chart-section">
    <h2>{{ __('5 Produk Terlaris') }}</h2>
    @if($topSellingProducts->isNotEmpty())
        <table>
            <thead>
            <tr>
                <th>{{ __('Produk') }}</th>
                <th>{{ __('Jumlah Terjual') }}</th>
                <th>{{ __('Persentase') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topSellingProducts as $product)
                <tr>
                    <td>{{ $product['product']->name ?? __('Produk Dihapus') }}</td>
                    <td>{{ number_format($product['total_quantity'], 0, ',', '.') }} pcs</td>
                    <td>
                        {{ number_format(($product['total_quantity'] / $totalProductsPurchased) * 100, 1) }}%
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="text-gray-500">{{ __('Tidak ada data produk terlaris') }}</div>
    @endif
</div>

<div class="footer">
    <div>{{ __('Dihasilkan pada') }}: {{ $generatedAt }}</div>
    <div>{{ config('app.name') }} • {{ config('app.url') }}</div>
    <div class="text-xs text-gray-400">{{ __('Laporan ini dibuat otomatis oleh sistem') }}</div>
</div>
</body>
</html>
