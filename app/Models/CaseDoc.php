<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class CaseDoc extends Model
{
    use SoftDeletes;
    protected $table = 'case_docs';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
	protected $guarded = [];
}
