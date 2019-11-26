<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QualDocMast;
use App\Models\QualCatg;
use App\Models\QualDocType;
class QualDocMastController extends Controller
{
    
    public function index()
    {
        $docs_mast = QualDocMast::with('qual_category','qual_doc_type')->get();
        
        return view('admin.dashboard.master.qualification.doc_mast.index',compact('docs_mast'));
    }

   
    public function create()
    {
        $qual_categories = QualCatg::all();
        $doc_types = QualDocType::all();
        return view('admin.dashboard.master.qualification.doc_mast.create',compact('doc_types','qual_categories'));
    }

    
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'qual_catg_code' => "required",
            'qual_doc_type_id'=>"required|not_in:''",
           
        ],
        [
             'qual_catg_code.required' => "This field is required",
             'qual_doc_type_id.required' => "This field is required",
        ]
        );
       
        $qual_catg = QualCatg::find($request->qual_catg_code);
        $qual_catg->document_mast()->sync($request->qual_doc_type_id);

        return redirect()->route('qual_doc_mast.index')->with('success','Qualification Document Inserted Successfully');

    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
