<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualCatg extends Model
{
    protected $table = 'qual_catg_mast';

    public $timestamps = false;
	protected $guarded = [] ;
	protected $primaryKey = 'qual_catg_code';

 	public $incrementing =false;

 	public function document_mast(){
        return $this->belongsToMany('App\Models\QualDocMast', 'qual_doc_mast','qual_catg_code','qual_doc_type_id');
    }
    
}
