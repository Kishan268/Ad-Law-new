<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualMast extends Model
{
    protected $table = 'qual_mast';    
    public $timestamps = false;
	protected $guarded = [] ;
	protected $primaryKey = 'qual_code';

 	public $incrementing =false;
}
