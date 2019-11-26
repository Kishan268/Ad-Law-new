<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMast extends Model
{
    protected $table = "course_mast";
    protected $guarded = [];
    protected $primaryKey = "course_code";
    public $timestamps = false;
}
