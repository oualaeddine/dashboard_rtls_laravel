<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = ['person_id', 'piece_id', 'date_time'];

    public function person() {
        return $this->belongsTo(Person::class);
    }

    public function piece() {
        return $this->belongsTo(Piece::class, 'piece_id');
    }
}
