<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $table = 'user_courts';
	public $timestamps = false;
	protected $guarded = [] ;
	protected $primaryKey = 'court_code';
 	public $incrementing =false;

	public function users(){
 		return $this->belongsToMany('App\User','user_courts','court_code','user_id');
 	}
 	public function court_catg(){
 		return $this->belongsTo('App\Models\CourtMast','court_code');
 	}
}
