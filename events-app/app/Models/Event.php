<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'location', 'start_date', 'end_date', 'capacity', 'is_published'
    ];

    public function registrations(){
        return $this->hasMany(Registration::class);
    }
}
