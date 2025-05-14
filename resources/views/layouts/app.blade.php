<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 antialiased">
<div class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <img class="h-8 w-auto" src="{{ asset('123.png') }}" alt="Logo">
                        <span class="text-xl font-bold text-gray-800">{{ config('app.name', 'Bookkeeping') }}</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Dashboard</a>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Products</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Categories</a>
                    <a href="{{ route('purchases.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Purchases</a>
                    <a href="{{ route('expenses.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Expenses</a>
                    <a href="{{ route('revenues.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Revenues</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="menu-toggle" class="text-gray-600 hover:text-gray-900">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden absolute w-full bg-white shadow-lg">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('dashboard.index') }}" class="block text-gray-600 hover:bg-gray-50 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Dashboard</a>
                <a href="{{ route('products.index') }}" class="block text-gray-600 hover:bg-gray-50 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Products</a>
                <a href="{{ route('categories.index') }}" class="block text-gray-600 hover:bg-gray-50 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Categories</a>
                <a href="{{ route('purchases.index') }}" class="block text-gray-600 hover:bg-gray-50 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Purchases</a>
                <a href="{{ route('expenses.index') }}" class="block text-gray-600 hover:bg-gray-50 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Expenses</a>
                <a href="{{ route('revenues.index') }}" class="block text-gray-600 hover:bg-gray-50 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Revenues</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Bookkeeping ') }}. All rights reserved.
            </p>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mobile menu toggle
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>
