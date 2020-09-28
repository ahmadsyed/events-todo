<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'email'
    ];
    /**
     * The roles that belong to the user.
     */
    public function events()
    {
        return $this->belongsToMany('App\Models\Event');
    }
}