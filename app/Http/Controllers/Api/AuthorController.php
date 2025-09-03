<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function top()
    {
        $authors = Author::withCount(['books as voter_count' => function ($q) {
                $q->join('ratings', 'books.id', '=', 'ratings.book_id')
                  ->where('ratings.rating', '>', 5);
            }])
            ->orderByDesc('voter_count')
            ->limit(10)
            ->get();

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
