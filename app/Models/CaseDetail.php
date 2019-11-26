<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class CaseDetail extends Model
{
   	use SoftDeletes;
    protected $table='case_detl';
    protected $primaryKey = 'case_tran_id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public function case(){
    	return $this->belongsTo('App\Models\CaseMast', 'case_id');
    }
    public function client(){
    	return $this->belongsTo('App\Models\Customer', 'cust_id');
    }
}
