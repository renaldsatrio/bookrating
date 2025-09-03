<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function top()
    {
        $authors = Author::withCount(['books as voter_count' => function($query) {
            $query->join('ratings', 'books.id', '=', 'ratings.book_id')
                  ->where('ratings.rating', '>', 5);
        }])
        ->orderByDesc('voter_count')
        ->take(10)
        ->get();

        return view('authors.top', compact('authors'));
    }
}
