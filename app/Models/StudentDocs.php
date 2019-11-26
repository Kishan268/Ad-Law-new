<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDocs extends Model
{
    protected $table = 'student_docs';
    protected $guarded = [];
    public function doc_type(){
    	return $this->belongsTo('App\Models\QualDocType','qual_doc_type_id');
    }
}
