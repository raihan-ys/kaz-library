<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    // Using SoftDeletes Trait.
    use SoftDeletes;

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

    // Defining 'deleted_at' column for soft deletes.
    protected $dates = ['deleted_at'];

    /**
     * Get the borrowings for the member.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get the member type that owns the member.
     */
    public function member_type()
    {
        // Define one-to-many relation with member types table.
        return $this->belongsTo(MemberType::class);
    }
}
