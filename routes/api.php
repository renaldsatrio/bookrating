<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\RatingController;

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/by-author/{id}', [BookController::class, 'byAuthor']);
Route::get('/authors/top', [AuthorController::class, 'top']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/ratings', [RatingController::class, 'store']);
