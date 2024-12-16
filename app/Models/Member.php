<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'type_id',
        'address',
        'phone',
        'email',
        'profile_photo',
    ];

    /**
     * Get the borrowings for the member.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
