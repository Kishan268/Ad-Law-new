<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    protected $table = 'slots';
  	 
 	protected $primaryKey = 'id';

 	protected $guarded = [];
 	public $timestamps = false;
}
