<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProfessionMast;
class ProfessionMastController extends Controller
{
    
    public function index()
    {
        $professions = ProfessionMast::all();
        return view('admin.dashboard.master.profession.index',compact('professions'));
    }

    
    public function create()
    {
        return view('admin.dashboard.master.profession.create');
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);

        $professions = ProfessionMast::all();
        if(count($professions) !=0){
            foreach ($professions as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

        ProfessionMast::create($data);

        return redirect()->route('profession.index')->with('success', 'Profession Name Inserted Successfully');
    }

   
    
    public function edit($id)
    {
        $profession = ProfessionMast::find($id);
        return view('admin.dashboard.master.profession.edit',compact('profession'));
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);
        ProfessionMast::find($id)->update($data);
        return redirect()->route('profession.index')->with('success', 'Profession Name Updated Successfully');
    }

    
    public function destroy($id)
    {
        ProfessionMast::find($id)->delete();
        return redirect()->back()->with('success', 'Profession Name Deleted Successfully');
    }
}
