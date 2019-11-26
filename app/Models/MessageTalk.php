<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageTalk extends Model
{
    protected $table = 'msg_talks';

    protected $guarded = [];

  	public function user(){
		return $this->belongsTo('App\User','id');
  	}
}
