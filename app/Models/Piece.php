<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    protected $fillable = ['cart_id', 'name', 'isInterdite', 'data', 'type'];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
