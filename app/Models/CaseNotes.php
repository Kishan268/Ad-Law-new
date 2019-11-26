<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class CaseNotes extends Model
{
    use SoftDeletes;
    protected $table = 'case_notes';
    protected $dates = ['deleted_at'];
	protected $guarded = [];
}
