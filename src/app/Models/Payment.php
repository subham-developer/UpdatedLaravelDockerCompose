<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }

    public function projectInterval(){
    	return $this->belongsTo('App\Models\ProjectInterval');
    }
}
