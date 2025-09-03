<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Author::factory()->count(1000)->create();

        \App\Models\Category::factory()->count(3000)->create();

        $batchSize = 10000;
        $totalBooks = 100000;
        for ($i = 0; $i < $totalBooks / $batchSize; $i++) {
            $books = \App\Models\Book::factory()
                ->count($batchSize)
                ->make([
                    'author_id' => fake()->numberBetween(1, 1000),
                    'category_id' => fake()->numberBetween(1, 3000),
                ])
                ->toArray();
            \App\Models\Book::insert($books);
        }

        $batchSize = 10000;
        $totalRatings = 500000;
        for ($i = 0; $i < $totalRatings / $batchSize; $i++) {
            $ratings = \App\Models\Rating::factory()
                ->count($batchSize)
                ->make([
                    'book_id' => fake()->numberBetween(1, $totalBooks), // random book
                ])
                ->toArray();
            \App\Models\Rating::insert($ratings);
        }
    }




}
