<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the members for the type.
     */
    public function members()
    {
        // Define one to many relation with members table.
        return $this->hasMany(Member::class);
    }
}
