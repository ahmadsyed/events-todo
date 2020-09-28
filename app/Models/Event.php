<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name'
    ];
    /**
     * The roles that belong to the user.
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant');
    }
}

