<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseLawyer extends Model
{
    protected $table = 'case_lawyer';
    public $timestamps = false;
	protected $guarded = [];

	
    protected $primaryKey = 'case_id';

 	public $incrementing =false;

 	public function member(){
 		return $this->belongsTo('App\User','user_id1');
 	}
 	public function case(){
 		return $this->belongsTo('App\Models\CaseMast','case_id');
 	}
 	
}
