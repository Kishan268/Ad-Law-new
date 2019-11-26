<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state_mast';
	 
 	protected $primaryKey = 'state_code';
    protected $guarded = [];

    public function country(){
    	return $this->belongsTo('App\Models\Country', 'country_code');
    }
}
