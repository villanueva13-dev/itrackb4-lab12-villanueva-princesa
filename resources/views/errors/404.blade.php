@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Page not found</h1>
    <p class="mb-4">The book page you are looking for could not be found. It may have been moved or the address may be incorrect.</p>
    <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">Back to the list</a>
</div>
@endsection