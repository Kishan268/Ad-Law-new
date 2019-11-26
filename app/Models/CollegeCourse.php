<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeCourse extends Model
{
    
    protected $table = "college_course";
    protected $guarded = [];
    
    public function course(){
    	return $this->belongsTo('App\Models\CourseMast', 'course_code');
    }
}
