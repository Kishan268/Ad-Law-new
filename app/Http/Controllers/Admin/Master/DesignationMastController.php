<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DesignationMast;
class DesignationMastController extends Controller
{
    
    public function index()
    {
        $designations = DesignationMast::all();
        return view('admin.dashboard.master.designation.index',compact('designations'));
    }

    
    public function create()
    {
        return view('admin.dashboard.master.designation.create');
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:50|min:1',
            'shrt_desc' => 'nullable|max:10|min:1',
        ]);

        $designations = DesignationMast::all();
        if(count($designations) !=0){
            foreach ($designations as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

        DesignationMast::create($data);

        return redirect()->route('designation.index')->with('success', 'Designation Name Inserted Successfully');
    }

    
    public function edit($id)
    {
        $designation = DesignationMast::find($id);
        return view('admin.dashboard.master.designation.edit',compact('designation'));
    }

   
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:50|min:1',
            'shrt_desc' => 'nullable|max:10|min:1',
        ]);
        DesignationMast::find($id)->update($data);
        return redirect()->route('designation.index')->with('success', 'Designation Name Updated Successfully');
    }

    
    public function destroy($id)
    {
        DesignationMast::find($id)->delete();
        return redirect()->back()->with('success', 'Designation Name Deleted Successfully');
    }
}
