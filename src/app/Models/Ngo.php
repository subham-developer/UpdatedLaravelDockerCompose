<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ngo extends Model
{
	use SoftDeletes;

    protected $fillable = ['name','address','registration_date','registration_number','email','mobile','landline','pancard'];
    
	public function setRegistrationDateAttribute($value)
    {
    	$this->attributes['registration_date'] = date_format(date_create($value),'Y-m-d');
    }

    public function getRegistrationDateAttribute($value)
    {
        return date_format(date_create($value),'d-m-Y');
    }

    public function getContactsAttribute($value)
    {
    	return json_decode($value);
    }

    public function getBankDetailsAttribute($value)
    {
        return json_decode($value);
    }
    
}
