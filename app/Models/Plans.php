<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'plans';  	 
 	protected $primaryKey = 'id';
 	public $incrementing =false;
 	public function slots(){
 		return $this->belongsTo('App\Slots','slot_id');
 	}
}
