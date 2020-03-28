<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    /*public function setRegistrationDateAttribute($value)
    {
        $this->attributes['registration_date'] = strtolower($value);
    }*/
    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }

    protected $casts = [
        // 'created_at' => 'date',
    ];

    public function project(){
    	return $this->belongsTo('App\Models\Project');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}