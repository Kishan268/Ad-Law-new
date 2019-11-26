<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\UserQualification;
use App\Models\CourseMast;
use App\Models\CollegeCourse;
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
        $courses = CourseMast::all();
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
        $data =  $this->validation($request);

        $course = CourseMast::find($data['course_code']);
        $clg = CollegeCourse::where('course_code',$data['course_code'])->where('user_id', Auth::user()->id)->get();
       // return $clg;

        if(count($clg)!=0){
            return redirect()->back()->with('warning','Course already inserted');
        }
        $data['course_desc'] = $course->course_desc;
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
        $courses = CourseMast::all();
        return view('lawschools.dashboard.courses.edit',compact('data','courses'));
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
        $course = CourseMast::find($data['course_code']);

        $data['course_desc'] = $course->course_desc;

        $user = CollegeCourse::find($id);
        $user->update($data);
        return redirect()->route('course.index')->with('success','Course Updated Successfully');
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
