<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city_mast';
    protected $guarded = [];
  	 
 	protected $primaryKey = 'city_code';
 	public function state(){
 		return $this->belongsTo('App\Models\State', 'state_code');
 	}
 	public function country(){
 		return $this->belongsTo('App\Models\Country', 'country_code');
 	}
}
