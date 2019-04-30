<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    protected $fillable = ['person_id', 'piece_id', 'date_time'];
}
