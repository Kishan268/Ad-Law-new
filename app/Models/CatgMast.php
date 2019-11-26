<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatgMast extends Model
{
    protected $table = "catg_mast";
    public $timestamps = false;
	protected $guarded = [] ;
	protected $primaryKey = 'catg_code';

 	public $incrementing =false;
}
