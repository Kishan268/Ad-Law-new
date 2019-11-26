<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtGroup extends Model
{
    protected $table='court_group_mast';   
    protected $primaryKey = 'court_group_code';
 	public $timestamps = false;
}
