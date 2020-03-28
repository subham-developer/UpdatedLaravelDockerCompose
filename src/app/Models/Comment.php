<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public function getCreatedAtAttribute($value)
    {
        return date_format(date_create($value),'d-m-Y');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
