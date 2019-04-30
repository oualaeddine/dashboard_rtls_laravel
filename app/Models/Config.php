<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    protected $fillable = [ 'broker_url', 'port', 'username', 'password',
        'chanel_subscribe', 'chanel_publish', 'path', 'baudrate'];

    public static function getConfig() {
        return Config::all()->first();
    }
}
