<?php

namespace App\Models;

use Carbon\Carbon;
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

        $dateStart = Carbon::parse($this->date_start);
        $dateEnd = Carbon::parse($this->date_end);

        $durationInMnutes = $dateEnd->diffInMinutes($dateStart);

        $hours = (int) ($durationInMnutes / 60);
        $minutes = $durationInMnutes;
        if($hours > 0) {
            $minutes = $durationInMnutes % 60;

            return "$hours H $minutes M";
        }

        return "$minutes M";
    }
}
