<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ['websiteName', 'domain', 'featureSettings', 'reportLink', 'userID'];

    public function uptimes() {
        return $this->hasMany('App\Uptime');
        return $this->hasMany('App\Url');
        return $this->belongsTo('App\User');
    }
}
