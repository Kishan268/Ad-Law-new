<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CatgMast;
use App\Models\SubCatgMast;
class SpecSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CatgMast::all();
        $subcategories = SubCatgMast::all();
        return view('admin.dashboard.master.specialization.subcategory.index',compact('subcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CatgMast::all();
        return view('admin.dashboard.master.specialization.subcategory.create',compact('categories'));
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
        $category = CatgMast::where('catg_code',$data['catg_code'])->first();
        $data['catg_desc'] = $category['catg_desc'];

        $catgs = SubCatgMast::all();
        if(count($catgs) !=0){
            foreach ($catgs as $value) {
                $data['subcatg_code'] = $value->subcatg_code +1;
            }
        }
        else{
            $data['subcatg_code'] ='1';
        }

        SubCatgMast::create($data);
        return redirect()->route('spec_subcategory.index')->with('success','Subcategory Insterted Successfully');
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
        $subcategory = SubCatgMast::find($id);

        $categories = CatgMast::all();
        return view('admin.dashboard.master.specialization.subcategory.edit',compact('categories','subcategory'));
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
        $category = CatgMast::where('catg_code',$data['catg_code'])->first();
        $data['catg_desc'] = $category['catg_desc'];    

        $subcategory = SubCatgMast::find($id);
        $subcategory->update($data);

        return redirect()->route('spec_subcategory.index')->with('success','Subcategory Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCatgMast::find($id)->delete();

        return redirect()->back()->with('success','Subcategory Deleted Successfully');

    }
    public function validation($request){
        return $request->validate([
            "catg_code"     => 'required|not_in:0',
            "subcatg_desc"  => 'required|string|max:100|min:3',
            "short_desc"    => 'nullable|string|max:15|min:3' 
        ]);
    }
    public function subCategoryFilter(Request $request){
        $subcategories = SubCatgMast::where('catg_code',$request->catg_code)->get();
        return view('admin.dashboard.master.specialization.subcategory.table',compact('subcategories'));
    }
}
