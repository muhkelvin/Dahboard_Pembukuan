@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Add Purchase</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('purchases.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product</label>
                <select name="product_id" id="product_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Kalau Belum Bayar Tulis Nama Pembeli">
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="total_price" class="block text-gray-700 text-sm font-bold mb-2">Total Price</label>
                <input type="hidden" name="total_price" id="total_price_numeric">
                <input type="text" id="total_price_display" value="{{ old('total_price') ? 'Rp ' . number_format(floatval(old('total_price')), 2, ',', '.') : '' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
            </div>

            <div class="mb-4">
                <label for="purchase_date" class="block text-gray-700 text-sm font-bold mb-2">Purchase Date</label>
                <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="payment_status" class="block text-gray-700 text-sm font-bold mb-2">Payment Status</label>
                <select name="payment_status" id="payment_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const totalPriceInput = document.getElementById('total_price_numeric');
            const totalPriceDisplay = document.getElementById('total_price_display');

            function formatRupiah(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                }).format(value).replace(/^Rp/, 'RP.');
            }

            function calculateTotalPrice() {
                const selectedProduct = productSelect.options[productSelect.selectedIndex];
                const price = parseFloat(selectedProduct.getAttribute('data-price'));
                const quantity = parseInt(quantityInput.value);

                if (!isNaN(price) && !isNaN(quantity)) {
                    const totalPrice = price * quantity;
                    totalPriceInput.value = totalPrice;
                    totalPriceDisplay.value = formatRupiah(totalPrice);
                } else {
                    totalPriceInput.value = '';
                    totalPriceDisplay.value = '';
                }
            }

            productSelect.addEventListener('change', calculateTotalPrice);
            quantityInput.addEventListener('input', calculateTotalPrice);
        });
    </script>
@endsection
