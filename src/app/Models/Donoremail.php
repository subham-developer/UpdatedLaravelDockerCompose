<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;


class Donoremail extends Model
{
	// use SoftDeletes;

  protected $fillable = ['subject','image_name','email_body'];

}
