<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .summary {
            margin-bottom: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .summary-item {
            width: 48%;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .label {
            font-weight: bold;
            color: #2c3e50;
        }
        .value {
            font-size: 1.2em;
            color: #27ae60;
        }
        .negative {
            color: #c0392b;
        }
        .top-products {
            margin-top: 30px;
        }
        .top-products h2 {
            color: #2c3e50;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 5px;
        }
        .top-products ul {
            list-style-type: none;
            padding-left: 0;
        }
        .top-products li {
            margin-bottom: 5px;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
<h1>Laporan Keuangan Dashboard</h1>

<div class="summary">
    <div class="summary-item">
        <div class="label">Total Pendapatan:</div>
        <div class="value">Rp {{ number_format($totalRevenues, 0, ',', '.') }}</div>
    </div>
    <div class="summary-item">
        <div class="label">Total Pembelian:</div>
        <div class="value">Rp {{ number_format($totalPurchases, 0, ',', '.') }}</div>
    </div>
    <div class="summary-item">
        <div class="label">Total Pengeluaran:</div>
        <div class="value">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</div>
    </div>
    <div class="summary-item">
        <div class="label">Pembelian Belum Lunas:</div>
        <div class="value negative">Rp {{ number_format($totalPendingPurchases, 0, ',', '.') }}</div>
    </div>
    <div class="summary-item">
        <div class="label">Profit:</div>
        <div class="value {{ $profit < 0 ? 'negative' : '' }}">Rp {{ number_format($profit, 0, ',', '.') }}</div>
    </div>
    <div class="summary-item">
        <div class="label">Total Produk Terbeli:</div>
        <div class="value">{{ number_format($totalProductsPurchased, 0, ',', '.') }} produk</div>
    </div>
</div>

<div class="top-products">
    <h2>5 Produk Terlaris</h2>
    <ul>
        @foreach($topSellingProducts as $product)
            <li>{{ $product['product']->name }}: {{ number_format($product['total_quantity'], 0, ',', '.') }} pcs</li>
        @endforeach
    </ul>
</div>

<footer>
    <p>Laporan ini mencakup periode: {{ $periodLabel }}</p>
    <p>Laporan dihasilkan pada {{ now()->format('d-m-Y H:i:s') }}</p>
</footer>
</body>
</html>
