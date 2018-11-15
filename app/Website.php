<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ['websiteName', 'domain', 'featureSettings', 'reportLink'];

    public function uptimes() {
        return $this->hasMany('App\Uptime');
    }
}
