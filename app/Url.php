<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['url', 'excludeLoadtimes', 'wordCount', 'metaDescription', 'altText', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'websiteID'];

    public function websites() {
        return $this->belongsTo('App\Website', 'websiteID');
    }
    public function loadtimes() {
        return $this->hasMany('App\Loadtime', 'urlID');
    }
}
