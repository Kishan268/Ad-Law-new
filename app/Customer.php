<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use SoftDeletes;
    protected $table = 'cust_mast';
    public $timestamps = false;
	protected $dates = ['deleted_at'];
	protected $guarded = [];

	protected $primaryKey = 'cust_id';
	public $incrementing =true;
}