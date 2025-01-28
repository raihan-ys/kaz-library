<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    // Using SoftDeletes Trait.
    use SoftDeletes;

    // The attributes that are mass assignable.
    protected $fillable = ['name'];

    // Defining 'deleted_at' column for soft deletes.
    protected $dates = ['deleted_at'];

    /**
     * Get the books for the publisher.
     */
    public function books()
    {
        // Define one to many relation with books table.
        return $this->hasMany(Book::class);
    }
}
