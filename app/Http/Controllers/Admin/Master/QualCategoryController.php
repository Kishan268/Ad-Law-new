<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QualCatg;

class QualCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualifics = QualCatg::all();
        return view('admin.dashboard.master.qualification.category.index',compact('qualifics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.dashboard.master.qualification.category.create');
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

         $qual = QualCatg::all();
        if(count($qual) !=0){            
            foreach ($qual as $value) {
                $data['qual_catg_code'] = $value->qual_catg_code +1;
            }
        } 
        else{
            $data['qual_catg_code'] = '1';
        }
       
        QualCatg::create($data);        
        return redirect()->route('qual_category.index')->with('success','Qualification Category Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $qual = QualCatg::find($id);   
        return view('admin.dashboard.master.qualification.category.edit',compact('qual'));
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
        $qual = QualCatg::find($id);
        $data = $this->validation($request);
        $qual->update($data);
        return redirect()->route('qual_category.index')->with('success','Qualification Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QualCatg::find($id)->delete();  
        return redirect()->back()->with('success','Qualification Category Deleted Successfully');
    }

    public function validation($request){
        return $request->validate([
            'qual_catg_desc' => 'required|max:50|min:3',
            'shrt_desc'      => 'nullable|max:5|min:1',
        ]);
    }
}
