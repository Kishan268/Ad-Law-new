<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTodo extends Model
{
    protected $table = 'user_todo';
    protected $guarded = [];
   	public $timestamps = false;
   	public $incrementing =false;

   	public function user(){
 		return $this->belongsTo('App\User','user_id');
 	}
 	public function todos(){
 		return $this->belongsTo('App\Models\Todo','todo_id');
 	}
}
