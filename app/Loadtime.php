<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loadtime extends Model
{
    protected $fillable = ['loadtime', 'urlID'];

    public function urls() {
        return $this->belongsTo('App\Url', 'urlID');
    }
}
