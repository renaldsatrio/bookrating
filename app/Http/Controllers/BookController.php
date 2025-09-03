<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Book::with('author')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings');

        if ($request->has('search') && $request->search != '') {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%")
                  ->orWhereHas('author', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
        }

        $books = $query->orderByDesc('ratings_avg_rating')
                       ->paginate($perPage);

        return view('books.index', compact('books', 'perPage'));
    }
}
