<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = ['user_id','title','slug','description', 'goal','commission','start_date', 'end_date','video_link','target', 'recurring_days','long_description'];
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date_format(date_create($value),'Y-m-d');
    }

    public function getStartDateAttribute($value)
    {
        return date_format(date_create($value),'d-m-Y');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = date_format(date_create($value),'Y-m-d');
    }

    public function getEndDateAttribute($value)
    {
        return date_format(date_create($value),'d-m-Y');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->hasMany('App\Models\ProjectImage');
    }

    public function interval(){
        return $this->hasMany('App\Models\ProjectInterval');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
        
    }
}
