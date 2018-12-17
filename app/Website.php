<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ['websiteName', 'domain', 'featureSettings', 'reportLink', 'user_id'];

    public function uptimes() {
        return $this->hasMany('App\Uptime', 'websiteID');
        return $this->belongsTo('App\User');
    }
    public function urls() {
        return $this->hasMany('App\Url', 'websiteID');
    }
}
