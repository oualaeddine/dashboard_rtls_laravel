<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $fillable = ['resident_id', 'pensionaire_id', 'duration', 'date_start'];

    public function resident() {
        return $this->belongsTo(Person::class, 'resident_id');
    }

    public function pensionaire() {
        return $this->belongsTo(Person::class, 'pensionaire_id');
    }

    public function getDuration() {

        $hours = (int) ($this->duration / 60);
        $minutes = $this->duration;
        if($hours > 0) {
            $minutes = $this->duration % 60;

            return "$hours H $minutes M";
        }

        return "$minutes M";
    }
}
