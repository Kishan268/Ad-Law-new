<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  	protected $table='blog_posts';
    protected $guarded = [];
    public $timestamps = true;

    public function b_status(){
    	return $this->belongsTo('App\Models\Status','status');
    }
}
