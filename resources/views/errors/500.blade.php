@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Something went wrong</h1>
    <p class="mb-4">The application could not complete your request. Please try again later.</p>
    <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">Back to the books list</a>
</div>
@endsection