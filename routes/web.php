<?php

use Illuminate\Support\Facades\Route;

// Halaman utama pakai Blade
Route::get('/', function () {
    return view('books/index'); // ini file resources/views/books.blade.php
})->name('books.index');

// Halaman Top Authors (Blade)
Route::get('/authors/top', function () {
    return view('authors.top');
})->name('authors.top');

// Halaman Create Rating
Route::get('/rating/create', function () {
    return view('ratings.create');
})->name('rating.create');
