<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourtType;
use App\Models\CourtGroup;

class CourtCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $court_types = CourtType::all(); 
        return view('admin.dashboard.master.court.category.index',compact('court_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courtgrups = CourtGroup::all();
        return view('admin.dashboard.master.court.category.create',compact('courtgrups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);
        $court_grp = CourtGroup::find($data['court_group_code']);

       
        $data['court_group_name'] = $court_grp->court_group_name;

        $oldtypes =  CourtType::all();
        if(count($oldtypes) !=0){
            foreach ($oldtypes as $value) {
                $id = $value->court_type;
            }
            $data['court_type'] = $id+1;
        }
        else{
            $data['court_type'] = '1';
        }

        CourtType::create($data);
        return redirect()->route('court_category.index')->with('success','Court Type Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courtgrups = CourtGroup::all();
        $court_type = CourtType::find($id);
        return view('admin.dashboard.master.court.category.edit',compact('courtgrups','court_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $court_grp = CourtGroup::find($data['court_group_code']);       
        $data['court_group_name'] = $court_grp->court_group_name;

        $court_type =  CourtType::find($id);
        $court_type->update($data);
        return redirect()->route('court_category.index')->with('success','Court Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $court_type =  CourtType::find($id)->delete();
        return redirect()->back()->with('success','Court Type Deleted Successfully');
    }
    public function validation($request){
        return $request->validate([
            'court_group_code'  => 'required|not_in:0',
            'court_type_desc'   => 'required|string|max:50|min:3',
            'short_desc'        => 'required|string|max:10|min:2',
        ]);
    }
}
