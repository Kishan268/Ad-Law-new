<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Models\City;
use App\Models\State;

class CustomerController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');

	}
	public function index(){
		$states = State::all();

		return view('customer.dashboard.dashboard',compact('states'));
	}
    public function updateProfile(Request $request, $id){
    	$data = $request->validate([
				'dob'           => 'required|before:5 years ago|date_format:Y-m-d',
				'mobile'        => 'required|min:10|max:11|string',
				'state_code'    => 'required|not_in:0',
				'city_code'     => 'required|not_in:0',
				'gender'        => 'required|not_in:0',

    	]);
    	$data['country_code'] = 102;
    	User::where('id', $id)->update($data); 
    	return redirect()->back()->with('success', 'Your profile updated successfully');


    }
   
}
