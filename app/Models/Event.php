<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    protected $fillable = ['person_id', 'piece_id', 'actual_piece_id',
        'tx_pow', 'rssi', 'date_time'];

    public function piece() {
        return $this->belongsTo(Piece::class, 'piece_id');
    }

    public function actualPiece() {
        return $this->belongsTo(Piece::class, 'actual_piece_id');
    }
}
