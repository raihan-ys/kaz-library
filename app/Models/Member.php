<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'address',
        'phone',
        'email',
    ];

    /**
     * Get the borrowings for the member.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
