<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisiciondetalle extends Model
{
    protected $guarded=[];
    public $timestamps = false;

    public function requisicion()
    {
      return $this->belongsTo('App\Requisicion');
    }
}
