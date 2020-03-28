<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id','address','profile_image','os_type','registration_date','registration_number','mobile','landline','IMEI','auth_key'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at','deleted_at','auth_key'
    ];

    /*public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }*/

    public function setRegistrationDateAttribute($value)
    {
        $this->attributes['registration_date'] = date_format(date_create($value),'Y-m-d');
    }

    public function getRegistrationDateAttribute($value)
    {
        return date_format(date_create($value),'d-m-Y');
    }

    public function ngo(){
        return $this->hasOne('App\Models\Ngo');
    }
    public function projects(){
        return $this->hasMany('App\Models\Project');
    }

    public function intervals(){
        return $this->hasManyThrough('App\Models\ProjectInterval', 'App\Models\Project');
    }

    public function donation(){
        return $this->hasMany('App\Models\Donation');
    }
    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
}
