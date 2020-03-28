<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use DB;

class ProjectInterval extends Model
{
    protected $fillable = ['funded','completed'];
    protected $appends = ['encodeId','days_left'];
    protected $casts = [
        'end_date' => 'date',
    ];
    
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function payments(){
    	return $this->hasMany('App\Models\Payment');
    }

    public function getEncodeIdAttribute()
    {   
        // $id = Hashids::encode($this->id);
        // return $id;
        $query = DB::table('project_intervals')->where('id', $this->id)->get();
        $project_id = $query[0]->project_id;
        $slug_query = DB::table('projects')->where('id', $project_id)->get();
        return $slug_query[0]->slug;
    }

    public function getDaysLeftAttribute(){
        $now = Carbon::createMidnightDate(date('Y'), date('m'), date('d'));
        return $now->diffInDays($this->end_date)+1;
    }

    public function getStartDateAttribute($value)
    {
        return date_format(date_create($value),'d-m-Y');
    }

    public function getEndDateAttribute($value)
    {
        return date_format(date_create($value),'d-m-Y');
    }
}
