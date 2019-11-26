<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Religion;
class ReligionController extends Controller
{
   
 
    public function index()
    {
        $religions = Religion::all();
        return view('admin.dashboard.master.religion.index',compact('religions'));
    }

   
    public function create()
    {
        return view('admin.dashboard.master.religion.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);

        $religions = Religion::all();
        if(count($religions) !=0){
            foreach ($religions as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

        Religion::create($data);

        return redirect()->route('religion.index')->with('success', 'Religion Name Inserted Successfully');
    }

    
    public function edit($id)
    {
        $religion = Religion::find($id);
        return view('admin.dashboard.master.religion.edit',compact('religion'));

    }

    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);
        Religion::find($id)->update($data);
        return redirect()->route('religion.index')->with('success', 'Religion Name Updated Successfully');
    }

    
    public function destroy($id)
    {
        Religion::find($id)->delete();
        return redirect()->back()->with('success', 'Religion Name Deleted Successfully');
    }
}
