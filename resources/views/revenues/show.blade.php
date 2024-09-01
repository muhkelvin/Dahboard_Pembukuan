@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Revenue Details</h2>
        <p><strong>Description:</strong> {{ $revenue->description }}</p>
        <p><strong>Amount:</strong> {{ $revenue->amount }}</p>
        <p><strong>Date:</strong> {{ $revenue->revenue_date }}</p>
        <a href="{{ route('revenues.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Revenues</a>
    </div>
@endsection
