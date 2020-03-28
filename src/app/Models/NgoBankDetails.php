<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NgoBankDetails extends Model
{
    protected $table = 'ngo_bank_details';
    //
    protected $fillable = ['bank_name','account_number','beneficiary_name','ifsc'];

    public function getBankDetailsAttribute($value)
    {
        return json_decode($value);
    }

}


