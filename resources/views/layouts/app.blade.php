<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 antialiased leading-normal">

<div class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center">
                        <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo">
                        <span class="ml-3 text-xl font-semibold">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Dashboard</a>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Products</a>
                    <a href="{{ route('categories.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Categories</a>
                    <a href="{{ route('purchases.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Purchases</a>
                    <a href="{{ route('expenses.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Expenses</a>
                    <a href="{{ route('revenues.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Revenues</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-md mt-6">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </p>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
