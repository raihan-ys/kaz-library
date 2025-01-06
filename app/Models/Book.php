<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    // Using SoftDeletes Trait.
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_year',
        'category_id',
        'publisher_id',
        'cover_image',
        'stock',
        'rental_price',
    ];

    // Defining 'deleted_at' column for soft deletes.
    protected $dates = ['deleted_at'];

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
