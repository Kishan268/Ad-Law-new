<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'user_reviews';

    public $timestamps = false;

	protected $guarded = [] ;

 	const id = 'user_id'; 

    public function customers(){
    	return $this->belongsTo('App\User', 'guest_id');
    } 
}
