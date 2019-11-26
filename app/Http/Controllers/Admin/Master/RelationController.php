<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Relation;
class RelationController extends Controller
{
   
    public function index(){
        $relations = Relation::all();
        return view('admin.dashboard.master.relation.index',compact('relations'));
    }

    
    public function create(){
        return view('admin.dashboard.master.relation.create');
    }

    
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);

        $relations = Relation::all();
        if(count($relations) !=0){
            foreach ($relations as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

        Relation::create($data);

        return redirect()->route('relation.index')->with('success', 'Relation Name Inserted Successfully');
    }

    
    public function edit($id){
        $relation = Relation::find($id);
        return view('admin.dashboard.master.relation.edit',compact('relation'));
    }

   
    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);
        Relation::find($id)->update($data);
        return redirect()->route('relation.index')->with('success', 'Relation Name Updated Successfully');
    }

 
    public function destroy($id){
        Relation::find($id)->delete();
        return redirect()->back()->with('success', 'Relation Name Deleted Successfully');
    }
}
