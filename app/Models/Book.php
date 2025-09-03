<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id', 'category_id'];

    // Relasi ke Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Rating
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}

