<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function top()
    {
        $authors = Cache::remember('top_authors', now()->addMinutes(10), function () {
            return Author::select('authors.id', 'authors.name')
                ->selectRaw('COUNT(ratings.id) as voter_count')
                ->join('books', 'authors.id', '=', 'books.author_id')
                ->join('ratings', 'books.id', '=', 'ratings.book_id')
                ->where('ratings.rating', '>', 5)
                ->groupBy('authors.id', 'authors.name')
                ->orderByDesc('voter_count')
                ->limit(10)
                ->get();
        });

        return response()->json($authors);
    }

    public function index()
    {
        return Author::select('id', 'name')->orderBy('name')->get();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
