<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QualCatg;
use App\Models\QualMast;

class QualSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = QualCatg::all();
        $subcategories = QualMast::all();

        return view('admin.dashboard.master.qualification.subcategory.index',compact('categories','subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quali = QualCatg::all();
        return view('admin.dashboard.master.qualification.subcategory.create',compact('quali'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request) ;
        $category = QualCatg::find($data['qual_catg_code']);
        $data['qual_catg_desc'] = $category->qual_catg_desc;

         $oldsubcatg = QualMast::all();

        // $data['qual_code'] = count($oldsubcatg)+1;
         if(count($oldsubcatg) !=0){           
             foreach ($oldsubcatg as $value) {
                 $data['qual_code']  = $value->qual_code +1;
              }
          }         
          else{
            $data['qual_code'] = '1';
          }

        QualMast::create($data);

        return redirect()->route('qual_subcategory.index')->with('success','Subcategory Name Inserted Successfully');
        
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
        $subcategory = QualMast::find($id);
        $quali = QualCatg::all();
        return view('admin.dashboard.master.qualification.subcategory.edit',compact('quali','subcategory'));
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
        $data = $this->validation($request) ;
        $category = QualCatg::find($data['qual_catg_code']);
        $data['qual_catg_desc'] = $category->qual_catg_desc;

        $subcatg = QualMast::find($id);
        $subcatg->update($data);

        return redirect()->route('qual_subcategory.index')->with('success','Subcategory Name Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QualMast::find($id)->delete();
        return redirect()->back()->with('success','Subcategory Name Deleted Successfully');
    }
    public function validation($request){
        return $request->validate([
            'qual_catg_code' => 'required|not_in:0',
            'qual_desc'      => 'required|string|max:50|min:3',
        ],
        [
           'qual_catg_code.*'   => 'The selected category is invalid.',
           'qual_desc.required' =>  'The subcategory name field is required.',
           'qual_desc.min:3' => 'The subcategory name must be at least 3 characters.',
           'qual_desc.max:50' => 'The subcategory name may not be greater than 50 characters.',

        ]
    );
    }
    public function subCategoryFilter(Request $request){

        $subcategories = QualMast::where('qual_catg_code',$request->qual_catg_code)->get();

        return view('admin.dashboard.master.qualification.subcategory.table',compact('subcategories'));
    }
}
