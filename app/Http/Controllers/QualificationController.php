<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\UserQualification;
use App\Models\QualCatg;
use App\Models\QualMast;
use App\Models\QualDocMast;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'Hello';
        $qual_catgs = QualCatg::all();
        $qualis = UserQualification::where('user_id', Auth::user()->id)->get();
        return view('qualification.index', compact('qual_catgs', 'qualis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $course_catg = QualCatg::all();
      
        // return view('lawcollege.dashboard.qualification.create',compact('course_catg'));

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


        $qual_catg = QualCatg::find($data['qual_catg_code']);
        $qual = QualMast::find($data['qual_code']);

        $data['qual_catg_desc'] = $qual_catg->qual_catg_desc;
        $data['qual_desc'] = $qual->qual_desc;

        $user_qual = UserQualification::where('qual_catg_code',$data['qual_catg_code'])                     ->where('qual_code',$data['qual_code'])
                                  ->where('pass_year',$data['pass_year'])
                                  ->where('user_id',Auth::user()->id)
                                  ->get();

        $data['user_id'] = Auth::user()->id;    

        if(count($user_qual) ==0){
            UserQualification::create($data);           
            return redirect()->route('qualification.index')->with('success','Qualification updated successfully');
        }
        else{
            return redirect()->route('qualification.index')->with('warning','Already inserted');
        }    
        
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

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function validation($request){
        return $request->validate([
            'qual_catg_code'    => 'required|not_in:0',
            'qual_code'         => 'required|not_in:0',
            'pass_year'         => 'required|digits:4|integer|min:1900|max:'.(date('Y')).'',
            'pass_perc'         => 'required|max:6|regex:/^\d{0,6}(\.\d{1,2})?$/',
            'pass_division'     => 'required|not_in:0' 
        ],
        [   
            'qual_catg_code.*'   => 'The selected course type is invalid.',
            'qual_code.required' => 'The selected course name is invalid.',
            'qual_code.not_in:0' => 'The course name field is required.',
            'pass_year.required' => 'The passing year field is required.',
            'pass_year.digits'   => 'The passing year must be 4 digits.',
            'pass_year.regex'    => 'The passing year format is invalid.',
            'pass_perc.required' => 'The passing percentage field is required.',
            'pass_perc.regex'    => 'The passing percentage format is invalid.',
            'pass_division.*'    => 'The selected passing division is invalid.'
        ]);
    }
    public function qualCategory(){       
        $course_catg = QualMast::where('qual_catg_code',request()->qual_catg_code)
        ->get();
        return response()->json($course_catg);
    }
    public function qual_docs(){
        $documents = QualDocMast::with('qual_doc_type')->where('qual_catg_code',request()->qual_catg_code)->get();
        return response()->json($documents);
    }

}