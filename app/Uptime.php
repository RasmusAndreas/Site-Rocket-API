<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uptime extends Model
{
    protected $fillable = ['excludeDowntime', 'statusCode'];

    public function website() {
        return $this->belongsTo('App\Website');
    }
}
