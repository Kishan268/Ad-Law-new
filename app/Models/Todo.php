<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
	
    protected $guarded = [];

    public function todo_assign(){
        return $this->belongsToMany('App\Models\UserTodo', 'user_todo','todo_id','user_id');
    }
    public function users(){
    	return $this->hasMany('App\Models\UserTodo','todo_id');
    }
    
}
