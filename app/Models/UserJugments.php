<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJugments extends Model
{
    protected $table = 'user_judgments';
    public $timestamps = false;
	protected $guarded = [] ;
	public $incrementing =false;

    protected $primaryKey = 'user_id';
}
