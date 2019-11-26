<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtType extends Model
{
    protected $table = 'court_type_mast';
    protected $guarded=[];
    protected $primaryKey = 'court_type';
    public $timestamps = false;
 	
}
