<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\UserQualification;
use App\Models\CourseMast;
use App\Models\CollegeCourse;
use App\Models\QualCatg;
use App\Models\QualMast;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $courses = CollegeCourse::with('course')->where('user_id', Auth::user()->id)->get();
      return view('lawschools.dashboard.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = QualCatg::all();
        // dd($courses);
        return view('lawschools.dashboard.courses.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $data =  $request->validate(['qual_catg_code'=>'required','qual_code'=>'required','course_duration' =>'required|numeric|min:2|max:60','syllabus'=>'required']);
  // return $request->';
        
        $qualCatgDesc = QualMast::where('qual_code',$request->qual_code)->first();

        // if(count($qual_catg_desc)!=0){
        //     return redirect()->back()->with('warning','Course already inserted');
        // }
        $data['qual_catg_desc'] = $qualCatgDesc->qual_catg_desc;
        $data['qual_desc']  = $qualCatgDesc->qual_desc;
        $data['user_id'] = Auth::user()->id;

        CollegeCourse::create($data);
        return redirect()->route('course.index')->with('success','Course Inserted Successfully');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = CollegeCourse::with('course')->where('id',$id)->first();

        return view('lawschools.dashboard.courses.show',compact('data'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CollegeCourse::find($id);
        $courses = QualCatg::all();
        $qualCatgDesc = QualMast::where('qual_code',$data->qual_code)->first();
        $qual_catg_desc = $qualCatgDesc->qual_desc;
        return view('lawschools.dashboard.courses.edit',compact('data','courses','qual_catg_desc'));
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
        
        $data =  $request->validate(['qual_catg_code'=>'required','qual_code'=>'required','course_duration'=>'required|numeric|min:2|max:60','syllabus'=>'required']);
        if($data['qual_catg_code'] != 0){
            $qualCatgDesc = QualMast::where('qual_code',$request->qual_code)->first();
            $data['qual_catg_desc'] = $qualCatgDesc->qual_catg_desc;
            $data['qual_desc']  = $qualCatgDesc->qual_desc;
            $data['user_id'] = Auth::user()->id;
            $user = CollegeCourse::find($id);
            $user->update($data);
            return redirect()->route('course.index')->with('success','Course Updated Successfully');
        }else{
            return redirect()->back()->with('warning','Course already in record');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CollegeCourse::find($id)->delete();
        return redirect()->route('course.index')->with('success','Course Deleted Successfully');
    }
    public function validation($request){
        return $request->validate([
            'course_code' => 'required|not_in:0',
            'syllabus'    => 'required',
        ],
        [    
            'course_code.*' => 'The selected course name field required',
        ]);
    }
}
