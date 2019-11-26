<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    protected $table = "user_qual";
    public $timestamps = false;
	protected $guarded = [] ;

    protected $primaryKey = 'id';

 	public $incrementing =false;
 	public function users(){
 		return $this->belongsToMany('App\Users', 'user_qual','qual_code','user_id');
 	}
}
