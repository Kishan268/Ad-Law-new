<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
   	protected $table = 'user_specialization';
	public $timestamps = false;
	protected $guarded = [] ;
 	protected $primaryKey = 'user_id';
 	public $incrementing =false;

 	public function users(){
 		return $this->belongsToMany('App\User','user_specialization','catg_code','user_id');
 	}
 	public function specialization_catgs(){
 		return $this->belongsTo('App\Models\CatgMast','catg_code');
 	}
}
