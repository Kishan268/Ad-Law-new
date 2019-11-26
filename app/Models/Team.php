<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $guarded = [];
   
   	public function members_assign(){
        return $this->belongsToMany('App\Models\UserTeam', 'user_team','team_id','user_id');
    }
    public function members(){
    	return $this->hasMany('App\Models\UserTeam','team_id');
    }

}
