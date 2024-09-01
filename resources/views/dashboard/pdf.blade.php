<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .summary { margin-bottom: 20px; }
        .summary div { margin-bottom: 10px; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
<h1>Laporan Dashboard</h1>

<div class="summary">
    <div>Total Pembelian: Rp {{ number_format($totalPurchases, 2) }}</div>
    <div>Total Pengeluaran: Rp {{ number_format($totalExpenses, 2) }}</div>
    <div>Total Pendapatan: Rp {{ number_format($totalRevenues, 2) }}</div>
    <div class="total">Profit: Rp {{ number_format($profit, 2) }}</div>
</div>

<footer>
    <p>Laporan dihasilkan pada {{ now()->format('d-m-Y H:i:s') }}</p>
</footer>
</body>
</html>
