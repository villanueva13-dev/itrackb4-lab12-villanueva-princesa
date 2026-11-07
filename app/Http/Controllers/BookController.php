<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    public function index(Request $request)
{
    $query = Book::with('genre');

    $genreId = $request->query('genre_id');

    if ($genreId) {
        $query->where('genre_id', $genreId);
    }

    $genres = Genre::all();

    $books = $query->get();

    return view('books.catalog', compact('books', 'genres', 'genreId'));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'author' => 'required|min:3|max:255',
            'genre_id' => 'required|exists:genres,id',
            'price' => 'required|numeric|min:0.99',
            'year' => 'required|integer|min:1800|max:2026',
        ]);

        Book::create($validated + ['is_available' => true]);

        return redirect()->route('books.index')
            ->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
{
    return view('books.details', compact('book'));
}
    public function edit(Book $book)
{
    $genres = Genre::all();

    return view('books.edit', compact('book', 'genres'));
}
public function update(Request $request, Book $book)
{
    $validated = $request->validate([
        'title' => 'required|min:3|max:255',
        'author' => 'required|min:3|max:255',
        'genre_id' => 'required|exists:genres,id',
        'price' => 'required|numeric|min:0.99',
        'year' => 'required|integer|min:1800|max:2026',
    ]);

    $book->update($validated);
    Log::info('Book saved', ['id' => $book->id]);

    return redirect()->route('books.index')
        ->with('success', 'Book updated successfully!');
}

public function destroy(Book $book)
{
    abort_if($book->genre->books()->count() === 1, 403);

    $book->delete();

    return redirect()->route('books.index')
        ->with('success', 'Book deleted successfully!');
}
}