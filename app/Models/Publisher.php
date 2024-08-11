<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the books for the publisher.
     */
    public function books()
    {
        // Define one to many relation with books table.
        return $this->hasMany(Book::class);
    }
}
