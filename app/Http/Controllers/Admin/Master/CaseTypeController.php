<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CaseType;
use App\Models\CourtMast;
use App\Models\CourtType;
class CaseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $case_types =CaseType::all();
        return view('admin.dashboard.master.case_type.index',compact('case_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $court_types = CourtType::all();
        return view('admin.dashboard.master.case_type.create',compact('court_types'));
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
        
        $court_type = CourtType::find($data['court_type']);
        $court = CourtMast::find($data['court_code']);
        $data['court_name'] = $court->court_name;
        $data['court_type_name']  = $court_type->court_type_desc;


        $case_type = CaseType::all();     

        if(count($case_type) !=0){
            foreach ($case_type as $value) {
               $data['case_type_id'] = $value->case_type_id + 1;  
            }           
        }
        else{
            $data['case_type_id'] = '1';
        }

        CaseType::create($data);
        return redirect()->route('case_type.index')->with('success','Case Type Inserted Successfully');
        
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
        $court_types = CourtType::all();
        $case_type = CaseType::find($id);
        return view('admin.dashboard.master.case_type.edit',compact('court_types','case_type'));
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

        $court_type = CourtType::find($data['court_type']);
        $court = CourtMast::find($data['court_code']);
        $data['court_name'] = $court->court_name;
        $data['court_type_name']  = $court_type->court_type_desc;

        $case_type = CaseType::find($id);
        $case_type->update($data);

        return redirect()->route('case_type.index')->with('success','Case Type Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseType::find($id)->delete();
        return redirect()->back()->with('success','Case Type Deleted Successfully');
    }
    public function courtFilter(Request $request){
         $courts =   CourtMast::where('court_type',$request->court_type)->get();
         return response()->json($courts);
    }
    public function validation($request){
        return $request->validate([

            'court_type' => 'required|not_in:0',
            'court_code' => 'required|not_in:0',
            'case_type_desc' => 'required|string|max:45|min:2',
        ]);
       
       
    }
}
