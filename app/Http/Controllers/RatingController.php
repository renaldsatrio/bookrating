<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Author;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create()
    {
        $authors = Author::all();
        return view('ratings.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating'  => 'required|integer|min:1|max:10',
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'rating'  => $request->rating,
        ]);

        return redirect()->route('books.index')
                         ->with('success', 'Rating submitted!');
    }
}
