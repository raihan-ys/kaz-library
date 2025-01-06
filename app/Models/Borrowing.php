<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrowing extends Model
{
    // Using SoftDeletes Trait.
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'book_id',
        'librarian_id',
        'borrow_date',
        'return_date',
        'status',
        'rental_price',
        'late_fee',
    ];

    // Defining 'deleted_at' column for soft deletes.
    protected $dates = ['deleted_at'];

    /**
     * Get the member that owns the borrowing.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
    * Get the book that owns the borrowing.
    */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
    * Get the librarian that recorded the borrowing.
    */
    public function librarian()
    {
        return $this->belongsTo(User::class, 'librarian_id');
    }
}
