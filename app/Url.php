<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['url', 'excludeLoadtimes', 'htmlToText', 'wordCount', 'metaDescription', 'altText', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'websiteID'];

    public function website() {
        return $this->belongsTo('App\Website');
        return $this->hasMany('App\Loadtime');
    }
}
