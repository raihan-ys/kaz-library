<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'published_year',
        'category_id',
        'publisher_id',
        'isbn',
        'cover_image',
        'stock',
        'rental_price',
    ];

    /**
     * Get the category that owns the book.
     */
    public function category()
    {
        // Define one-to-many relation with categories table.
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the publisher that owns the book.
     */
    public function publisher()
    {
        // Define one-to-many relation with publishers table.
        return $this->belongsTo(Publisher::class);
    }
}
