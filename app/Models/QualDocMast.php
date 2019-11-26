<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualDocMast extends Model
{
    protected $table = 'qual_doc_mast';
    protected $guarded = [];
   public $timestamps = false;
    public function qual_category(){
    	return $this->belongsTo('App\Models\QualCatg','qual_catg_code');
    }
    public function qual_doc_type(){
    	return $this->belongsTo('App\Models\QualDocType','qual_doc_type_id');
    }
}
