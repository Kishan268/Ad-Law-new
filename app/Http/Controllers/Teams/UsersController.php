<?php

namespace App\Http\Controllers\Teams;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;
use Auth;
use App\User;
use App\Role;
use App\VerifyUser;
use App\Mail\UserMail;
use App\Models\Status;
use App\Models\RoleUser;
class UsersController extends Controller
{
	public function index(){
		$users = User::with(['state','city','country','role'])->get();
        return view('users.index',compact('users'));	
	}
	public function create(){
		$roles = Role::where('id','>', 1)->get();
		return view('users.create',compact('roles'));
	}
	public function store(Request $request){
		if(Auth::user()->user_catg_id == '1'){
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users',
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	            'user_catg_id'  => 'required|not_in:0',
	        ]);			
	        $data['parent_id'] = null;

		}
		else{
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users',
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	        ]);	

	        if(Auth::user()->user_catg_id == '4'){
	            $data['user_catg_id'] =  '6';
	        }
	        else{
	            $data['user_catg_id'] = '2';   
	        }
	        $data['parent_id'] = Auth::user()->id;

		}

		// return $data;
        $this->create_user($data);

		if(Auth::user()->user_catg_id == '1'){
			return redirect()->route('users.index')->with('success','User created successfully');
		}
		else{
			return redirect()->route('teams.index')->with('success','User created successfully');
		}
       
	}

    public function show($id){
    	$users = User::where('parent_id',$id)->get();
    	return view('users.show',compact('users'));
    }
    public function edit($id){
    	$user = User::find($id);
    	$roles = Role::where('id','>', 1)->get();
        return view('users.edit',compact('countries','user','roles'));
    }
    public function update(Request $request, $id){
    	$olduser = User::find($id);

    	if(Auth::user()->user_catg_id == '1'){
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users,email,'.$id,
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	            'user_catg_id'  => 'required|not_in:0',
	        ]);			
	        $data['parent_id'] = null;

		}
		else{
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users,email,'.$id,
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	        ]);	

	        if(Auth::user()->user_catg_id == '4'){
	            $data['user_catg_id'] =  '6';
	        }
	        else{
	            $data['user_catg_id'] = '2';   
	        }
	        $data['parent_id'] = Auth::user()->id;

		}

		if($olduser->email != $data['email']){
            VerifyUser::where('user_id',$id)->delete();
            RoleUser::where('user_id',$id)->delete();
            User::find($id)->delete();
            $this->create_user($data);
        }
        else{
            $olduser->update($data);
        }

        if(Auth::user()->user_catg_id == '1'){
			return redirect()->route('users.index')->with('success','User updated successfully');
		}
		else{
			return redirect()->route('teams.index')->with('success','User updated successfully');
		}

    }
    public function destroy($id){
		VerifyUser::where('user_id',$id)->delete();
		RoleUser::where('user_id',$id)->delete();
		User::find($id)->delete();
		return redirect()->back()->with('success','User deleted successfully');
    }
    public function create_user($data){
        $status = Status::all();
        $status_id = $status[2]->status_id;

        $password  = str_limit($data['name'],3,'@845');
        $data['password'] = Hash::Make($password);
        $data['status']    = $status_id;

        $user = User::create($data);
        $user->attachRole($user->user_catg_id);
        
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
        $user['password'] = $password;
        Mail::to($user->email)->send(new UserMail($user));
    }

    public function login_history(){
		$id =  request()->id;
		$user =  User::find($id);
		return response()->json($user);
    }
    public function member_cases(){
       $id =  request()->id;
       $user =  User::find($id);
       // return $member;
       return response()->json($user);
    }
}
