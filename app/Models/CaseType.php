<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseType extends Model
{
    protected $table='case_type_mast';
    protected $guarded= [];

    protected $primaryKey = 'case_type_id';

 	public $incrementing =false;
}
