<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use App\User;
use App\Models\State;
use App\Models\UserQualification;
use App\Models\QualCatg;
use App\Models\QualMast;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){
        
           return view('teacher.dashboard.dashboard');
        
    }

    public function showProfile(){
    
    	$teacher = User::find(Auth::user()->id);
    	return view('teacher.dashboard.profile',compact('teacher'));
    }

    public function editProfile($id){
    	$states = State::all();
      $college =DB::table('college_mast_view')->get();
      $teacher = User::find($id);
    	return view('teacher.dashboard.edit_profile',compact('teacher','states','college'));
    }

    public function updateProfile(Request $request,$id){

    	$user_flag = $request->user_flag;
   
       if($user_flag=='ct'){
          $teacher = $this->validaeUnderLawRequest();

            $teacher['user_flag'] = 'P';
            $teacher['parent_id'] = $request->parent_id;

          if($request->photo !=null ){
            $this->storeImage($request);
          }
    
          User::where('id', $id)->update($teacher); 
          
          return redirect()->route('teacher.showProfile')->with('success', "Profile updated successfully and send a message to the college approval that you are a teacher of the college or not");
          }

       
       else{

          $id = Auth::user()->id;

          $teacher = $this->validateRequest();   

          $teacher['parent_id'] = Auth::user()->parent_id;
              
          if($request->photo !=null ){
              $this->storeImage($request);
          }
           User::where('id', $id)->update($teacher); 
          return redirect()->route('teacher.showProfile')->with('success', 'Profile Updated Sucessfully');
        }
    	 
    	
    }

 public function validateRequest(){

      return request()->validate([
          'name'          => ['required', 'string', 'max:255' ],
          'email1'        => 'nullable|email',
          'gender'        => 'required|not_in:0',
          'dob'           => 'required|before:5 years ago|date_format:Y-m-d',
          'mobile'        => 'required|min:10|max:11|string',
          'mobile_no1'    => 'nullable|min:10|max:11|string',
          'country_code'  => 'required',
          'state_code'    => 'required|not_in:0',
          'city_code'     => 'required|not_in:0',
          'aadhar_card'   => 'required|min:12|max:12|string',
          'pan_card'      => 'nullable|min:6|max:10|string',
          'zip_code'      => 'required|min:6|max:6|string',
          'detl_profile'  => 'nullable',
          'estd_year'     => 'nullable|numeric',
          'user_flag'     => 'nullable',

    ]);

    
  }
    public function validaeUnderLawRequest(){
    return request()->validate([
          'name'        => ['required', 'string', 'max:255' ],
          'email1'      => 'nullable|email',
          'gender'      => 'required|not_in:0',
          'dob'         => 'required|before:5 years ago|date_format:Y-m-d',
          'mobile'      => 'required|min:10|max:11|string',
          'mobile_no1'  => 'nullable|min:10|max:11|string',
          'country_code'=> 'required',
          'state_code'  => 'required|not_in:0',
          'city_code'   => 'required|not_in:0',
          'aadhar_card' => 'required|min:12|max:12|string',
          'pan_card'    => 'nullable|min:6|max:10|string',
          'zip_code'    => 'required|min:6|max:6|string',

          'detl_profile'=> 'nullable',
          'estd_year'   => 'nullable|numeric',
  
          'user_flag'   => 'required',
          'parent_id'   => 'required|not_in:0'
   ]);

  }

  public function storeImage($request){

      $request->validate([
            'photo' =>'required|image|mimes:jpeg,png,jpg|max:2048' 
            ]);


            $filename = Auth::user()->id.'_profilephoto'.time().'.'.$request->photo->getClientOriginalExtension();

            $id = Auth::user()->id;

            $teacher['photo'] =$filename;

            $oldphoto = Auth::user()->photo;
            
            User::where('id', $id)->update($teacher);

            $image = $request->photo->storeAs('public/profile_photo', $filename);

            if($oldphoto !=''){
              Storage::delete('public/profile_photo/'.$oldphoto);
            }

            return redirect('/teacher/profile')->with('success', 'Profile Updated Sucessfully');
 }

 public function Qualification(){
 	  $course_types = QualCatg::all();

    $teacherCourses = UserQualification::where('user_id', Auth::user()->id)->get();
    return view('teacher.dashboard.teacher_quali', compact('course_types', 'teacherCourses'));
 }

 public function storeQualification(Request $request)
    {
    	request()->validate([
          'course_type'     => 'required|not_in:0',
          'course'          => 'required|not_in:0',
          'pass_year'       => 'required|numeric|min:1960|max:'.date("Y").'',
          'pass_percentage' => 'required|numeric|min:1|max:100',
          'pass_division'   => 'required|not_in:0' 
      ]);

     $qual_catg_code1 = explode(',',$request->course_type);
     $qual_code1    = explode(',',$request->course);

    $oldQualifi = UserQualification::where('qual_catg_code', $qual_catg_code1[0])
                  ->where('qual_code',$qual_code1[0])
                  ->where('pass_year',$request->pass_year)
                  ->where('user_id',$request->user_id)
                  ->get();

    if(count($oldQualifi) ==0){
          $data = [
              'user_id'        => $request->user_id,
              'qual_catg_code' => $qual_catg_code1[0],
              'qual_catg_desc' => $qual_catg_code1[1],
              'qual_code'      => $qual_code1[0],
              'qual_desc'      => $qual_code1[1],
              'pass_year'      => $request->pass_year,
              'pass_perc'      => $request->pass_percentage,
              'pass_division' =>  $request->pass_division
          ];

          UserQualification::create($data);

          return redirect('teacher/qualification')->with('success','Qualification updated successfully');
        }
        else{

          return redirect('teacher/qualification')->with('warning','Already inserted');
        }
     
        


    }

    public function qualCategory(){

    $course_catg = QualMast::where('qual_catg_code',request()->qual_catg_code)
                  ->get();

     return response()->json($course_catg);

  }
 
}