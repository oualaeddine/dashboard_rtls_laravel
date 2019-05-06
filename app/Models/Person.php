<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = ['firstname', 'lastname', 'uid_bracelet', 'type'];

    public function fullname() {
        return $this->firstname . ' ' . $this->lastname;
    }
}
