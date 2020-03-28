<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Razorpaycredentials extends Model
{
	protected $fillable = [
		'RAZORPAY_KEY', 'RAZORPAY_SECRET', 'status',
	];
}
