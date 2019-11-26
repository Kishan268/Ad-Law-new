<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportFile;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMessage;
use App\Models\UserProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	 public function export_users() 
    {
        return Excel::download(new ExportFile, 'users.xlsx');
    }

  public function vacant_user(Request $request){
  	$id = $request->id;
  	$user = User::find($id);
   	$user->name = $user->name.' (vacated)';
   	$user->password = bcrypt('laxyo123');
   	$user->save();
	  return response()->json($user,201);
  	
  }
	public function welcomeMessage($email,$password,$name)
	{
		Mail::to($email)->send(new WelcomeMessage($password,$email,$name)); 
	}

	public function index()
	{
		$users = User::orderBy('name', 'asc')->get();
		return response()->json($users, 200);
	}

	public function search(Request $request) {
		$keyword = $request->keyword;
		if(!empty($keyword)){

		$users = User::where('name', 'ILIKE', '%'.$keyword .'%')
					->orWhere('email', 'ILIKE', '%'.$keyword .'%')
					->orderBy('created_at', 'desc')
					->paginate(10);
		}else{
			$users = User::orderBy('created_at', 'desc')->paginate(10);
		}
		return $users;
	}

	public function changePassword(Request $request)
	{
		$user = User::find(auth()->user()->id);

		if(Hash::check($request->old_password, $user->password)) {
			$user->password = bcrypt($request->new_password);
			$user->save();

			$class = 'alert alert-success';
			$status = 'Password Updated!';
		} else {
			$class = 'alert alert-danger';
			$status = 'Old password incorrect!';
		}
		return redirect()->back()->with(['class' => $class, 'status' => $status]);
	}

	public function store(Request $request)
	{
			$postData = $request->validate([
				'name'=>'required',
				'email'=>'required|unique:users'
			]);
			$random_pass = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8));
			$user = new User;
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = Hash::make($random_pass);
			$user->save();

			$data= $this->welcomeMessage($user->email,$random_pass,$user->name); 

			return response()->json($user, 201);
	}

	public function show($id)
	{
		$user = User::with('user_in_teams', 'user_has_roles.permissions', 'user_has_direct_permissions')
					->where('id', $id)
					->first();
		return response()->json($user, 200);
	}

	public function edit($id)
	{
			$user = User::findOrFail($id);
			return response()->json($user, 200);
	}

	public function update(Request $request, $id)
	{
			$postData = $request->validate([
				'name'=>'required',
				'email'=>'required|unique:users,email,' . $id,
			]);
			$user = User::findOrFail($id);
			$user->name = $request->name;
			$user->email = $request->email;
			$user->update();

			$users = User::where('id', $user->id)->first();
			return $users;
	}

	public function destroy($id)
	{
			$user = User::findOrFail($id)->delete();
			return response(200);
	}

	public function assignPermissions(Request $request, $id)
	{
			$user = User::findOrFail($id);
			$array = array();
			foreach($request->permissions as $permission) {
				$array[] = $permission['id'];
			}
			$user->syncPermissions($array);
	}

	public function assignRoles(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$array = array();
		foreach($request->roles as $role) {
			$array[] = $role['id'];
		}
		$user->syncRoles($array);
	}

	public function sendCredentials($id){
			// Generate New Password
			$random_pass = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8));

			// Update password in table
			$user = User::findOrFail($id);
			$user->password = Hash::make($random_pass);
			$user->update();

			$response = array(
					'message' => 'success',
					'new_password' => $random_pass
			);
			
			// Send the password through email
			Mail::to($user->email)->send(new WelcomeMessage($random_pass, $user->email, $user->name)); 
			return response()->json($response, 200);
	}

	public function userFileStackSync() {
		$users = User::whereNull('filestack_id')->get();
		foreach($users as $user){
			DB::transaction(function () use ($user) { 
				$insert_data = array('title' => $user->name, 'type' => 14);
				$db_filestack_id = DB::table('filestacks')->insertGetId($insert_data);

				$user = User::find($user->id);
				$user->filestack_id = $db_filestack_id;
				$user->save();
			});
		}
		return 'Success';
	}
}