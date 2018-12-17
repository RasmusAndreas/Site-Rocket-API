<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uptime extends Model
{
    protected $fillable = ['excludeDowntime', 'statusCode', 'websiteID'];

    public function websites() {
        return $this->belongsTo('App\Website', 'websiteID');
    }
}
