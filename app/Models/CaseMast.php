<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class CaseMast extends Model
{
    use SoftDeletes;
    protected $table = 'case_mast';
	protected $guarded = [];
    protected $primaryKey = 'case_id';
    protected $dates = ['deleted_at'];
	
    public function casetype(){
    	return $this->belongsTo('App\Models\CaseType','case_type_id');
    }
    public function client(){
        return $this->belongsTo('App\Models\Customer','cust_id');
    }
    public function court(){
        return $this->belongsTo('App\Models\CourtType','court_type');
    }
    public function members(){
        return $this->hasMany('App\Models\CaseLawyer','case_id');
    }
    public function state(){
        return $this->belongsTo('App\Models\State','state_code');
    }
    public function city(){
        return $this->belongsTo('App\Models\City','city_code');
    }
}
