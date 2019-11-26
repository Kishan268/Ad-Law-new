<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QualDocType;
class QualDocTypeController extends Controller
{
 
    public function index()
    {
        $doc_types = QualDocType::all();
        return view('admin.dashboard.master.qualification.doc_type.index',compact('doc_types'));
    }

    
    public function create()
    {
        return view('admin.dashboard.master.qualification.doc_type.create');
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:40|min:1',
            'shrt_desc' => 'nullable|max:10|min:1',
        ]);

        $doc_types = QualDocType::all();
        if(count($doc_types) !=0){
            foreach ($doc_types as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

        QualDocType::create($data);

        return redirect()->route('qual_doc_type.index')->with('success', 'Qualification Document Type Name Inserted Successfully');
    }

   
    public function edit($id)
    {
        $doc_type = QualDocType::find($id);
        return view('admin.dashboard.master.qualification.doc_type.edit',compact('doc_type'));
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:40|min:1',
            'shrt_desc' => 'nullable|max:10|min:1',
        ]);
        QualDocType::find($id)->update($data);
        return redirect()->route('qual_doc_type.index')->with('success', 'Qualification Document Type Name Updated Successfully');
    }

    
    public function destroy($id)
    {
        QualDocType::find($id)->delete();
        return redirect()->back()->with('success', 'Qualification Document Type Name Deleted Successfully');
    }
}
