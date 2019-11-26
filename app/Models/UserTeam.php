<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    protected $table = 'user_team';
    protected $guarded = [];

  //   public function teams(){
 	// 	return $this->belongsToMany('App\Models\Team','user_team','user_id','team_id');
 	// }
 	public function users(){
 		return $this->belongsTo('App\User','user_id');
 	}
 
}

