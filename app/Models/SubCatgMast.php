<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCatgMast extends Model
{
    protected $table = "subcatg_mast";
    public $timestamps = false;
	protected $guarded = [] ;
	protected $primaryKey = 'subcatg_code';

 	public $incrementing =false;
}
