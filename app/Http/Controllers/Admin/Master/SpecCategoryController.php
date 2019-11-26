<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CatgMast;
class SpecCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CatgMast::all(); 
        return view('admin.dashboard.master.specialization.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.dashboard.master.specialization.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data  = $this->validation($request);
        $catgs =CatgMast::all();
        if(count($catgs) !=0){
            foreach ($catgs as $value) {
                $data['catg_code'] = $value->catg_code +1;
            }
        }
        else{
            $data['catg_code'] = '1';
        }

        CatgMast::create($data);
        return redirect()->route('spec_category.index')->with('success','Specialization Category Inserted Successfully');

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
        $category = CatgMast::find($id);

        return view('admin.dashboard.master.specialization.category.edit',compact('category'));
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
        $data  = $this->validation($request);
        $category = CatgMast::find($id);
        $category->update($data);
        
        return redirect()->route('spec_category.index')->with('success','Specialization Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CatgMast::find($id)->delete();
        return redirect()->back()->with('success','Specialization Category Deleted Successfully');
    }
    public function validation($request){
        return $request->validate([
            'catg_desc' => 'required|string|max:100|min:3',
            'short_desc'=> 'nullable|string|max:10|min:2',
        ]);
    }
}
