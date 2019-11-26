<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\CatgMast;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Models\CaseNotes;
use App\Models\CaseDetail;
use App\Models\CaseDoc;
use App\Models\CaseType;
use App\Models\CourtMast;
use App\Models\CaseStatusMast;
use App\Models\SubCatgMast;
use App\Models\CourtType;
use App\Models\CaseLawyer;
use App\Models\Team;
use App\Models\UserTeam;
use App\Helpers\Helpers;

class CaseMastController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$case_status = CaseStatusMast::all();
	
		return view('case_management.case.index',compact('case_status'));
	}

	public function create(){       
		$id = explode(',', Request()->cust_id);
		$cust_id = $id[0];
		$page_name = $id[1];
		$case_types = CaseType::all();
		$courts = CourtType::all();
		$categories = CatgMast::all();
		$states = State::all();
		$deleted_clients = Helpers::deletedClients();
		$clients = Customer::where('user_id',Auth::user()->id)->whereNotIn('cust_id',$deleted_clients)->where('status_id','A')->get();  

		$case_status = CaseStatusMast::all();
		$teams = Team::where('user_id', Auth::user()->id)->get();
		return view('case_management.case.create', compact('cust_id','case_types','courts','page_name','clients','categories','states','case_status','teams'));
	}


	public function store(Request $request){

		$id ="";
		$data = $this->validate_data($request,$id);
		$data['team_id'] = $request->team_id;

		$verify = $request->validate([
			'users_id' => 'required|not_in:""',					
		]);

		$case = CaseMast::create($data);

		foreach ($verify as $value) {
			foreach($value as $val){
				$data = [
					'case_id' => $case->case_id,
					'user_id' => Auth::user()->id,
					'user_id1' => $val,
					'allocate_date' => date('Y-m-d'),
				];
				CaseLawyer::create($data);
			}
		}
 
		$page_name = $request->page_name;
		if($page_name == 'clients'){
			return redirect()->route('clients.show',$data['cust_id'])->with('success','Client case inserted successfully');
		}
		else{
			return redirect()->route('case_mast.index',['caseBtn' =>'cg'])->with('success','Case inserted successfully');
		}

	}


	public function show($id){

		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case = CaseMast::with('casetype','client','court','state','city')
					->with(['members' => function($query){
						$query->with('member');
					}])		
			       	->where('case_id', $case_id)
			        ->first();
		
		// return $case;
		return view('case_management.case.show', compact('case','page_name'));
	}


	public function edit($id){
		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_types = CaseType::all();
		$courts = CourtType::all();
		$categories = CatgMast::all();
		$states = State::all();
		$deleted_clients = Helpers::deletedClients();
		$clients = Customer::where('user_id',Auth::user()->id)->whereNotIn('cust_id',$deleted_clients)->where('status_id','A')->get();  

		$case_status = CaseStatusMast::all();

		$case = CaseMast::find($case_id);
		$teams = Team::where('user_id', Auth::user()->id)->get();

		$assign_mem = CaseLawyer::where('deallocate_date',null)->where('case_id',$id)->get();

		if($case->team_id == 0){
            $members = User::where('parent_id',Auth::user()->id)->where('status','!=','S')->get();
        }
        else{
            $members = UserTeam::with('users')->where('team_id',$case->team_id)->get();
        }
        // return $members;

		return view('case_management.case.edit',compact('case_types','courts','page_name','clients','categories','states','case_status','case','teams','assign_mem','members'));
	}


	public function update(Request $request, $id){

		$data = $this->validate_data($request,$id);
		$data['team_id'] = $request->team_id;
		$verify = $request->validate([
			'users_id' => 'required|not_in:""',			
		]);
		// return $verify;

		CaseMast::find($id)->update($data);

		$assign_mem = CaseLawyer::where('deallocate_date',null)->where('case_id',$id)->get();
	  // return $assign_mem;
		$ids = array();
		foreach ($verify as $value) {			
			foreach($value as $val){
				$da[] = $val;
			}
		}
		foreach ($assign_mem as $assign_m) {
			$assign [] = $assign_m->user_id1;			
		}

		$de_id = array_diff($assign,$da);
		$new_rec = 	array_diff($da, $assign);

		if(!(empty($de_id))){
			$deall['deallocate_date'] = date('Y-m-d');
			CaseLawyer::where('case_id',$id)->whereIn('user_id1',$de_id)->update($deall);
			print_r($de_id);
		}

		if(!(empty($new_rec))){
			foreach ($new_rec as $value) {
				$data = [
					'case_id' => $id,
					'user_id' => Auth::user()->id,
					'user_id1'=> $value,
					'allocate_date' => date('Y-m-d'),
				];
				CaseLawyer::create($data);
			}
		}
		$page_name = $request->page_name;

		if($page_name == 'clients'){
			return redirect()->route('clients.show',$data['cust_id'])->with('success','Client case Updated successfully');
		}
		else{
			return redirect()->route('case_mast.index',['caseBtn' =>'cg'])->with('success','Case Updated successfully');
		}
	}


	public function destroy($id){
		CaseMast::where('case_id',$id)->delete();
		return redirect()->back()->with('success', 'Client case deleted successfully');
	}
	public function caseValidation($request){

		$data = $request->validate([
			'court_type'		=> 'required|not_in:0',
			'case_reg_date'     => 'required|date_format:Y-m-d',
			'case_title'        => 'required|string|min:5|max:150',
			'catg_code'      	=> 'required|not_in:0',
			'subcatg_code'      => 'required|not_in:0',
			'appellant_name'    => 'nullable|string|max:250',
			'respondant_name'   => 'nullable|string|max:250',
			'case_fees'         => 'nullable|max:12|regex:/^\d{0,9}(\.\d{1,2})?$/',
			'case_status'       => 'required|not_in:0',
			'cust_id'           => 'required|not_in:0',
			'case_description'  => 'required|string',
		]);      
	

		 $courts = CourtType::where('court_type',$request->court_type)->first();
		 $data['court_type_desc'] = $courts->court_type_desc;
		 return $data;


	}
	public function validate_data($request,$id){

		$data = $this->caseValidation($request);


		if($data['court_type'] == '1'){
			$verify = $request->validate([
					'no_catg' => 'required|not_in:0',
				]
			);
			if($verify['no_catg'] == 'c_no'){
				$verify = $request->validate([
					'case_type_id' => "required|not_in:0",
					'c_d_number' => "required|string|min:1|max:5",
				],
				[
					'c_d_number.required' => 'The case number field is required.',
					'c_d_number.max' => 'The case number may not be greater than 4 characters.',
				]);
				$data['c_d_number'] 	= $verify['c_d_number'];
				$data['case_type_id'] 	= $verify['case_type_id'];
				$data['c_d_flag'] = 'c';
			}
			else{
				$verify = $request->validate([
					'c_d_number' => "required|string|min:1|max:5",
				],
				[
					'c_d_number.required' => 'The diary number field is required.',
					'c_d_number.max' => 'The diary number may not be greater than 4 characters.',
				]);
				$data['c_d_number'] 	= $verify['c_d_number'];
				$data['c_d_flag'] 		= 'd';
			}
		}
		else if($data['court_type'] == '2' || $data['court_type'] == '3'){
			$verify = $request->validate([
				'cnr' => 'required'
			]);			
			if($verify['cnr'] == '1'){

				$verify = $request->validate([
					'cnr_number' => 'required|min:14|max:16|string',
				]);
				$case = CaseMast::where('cnr_number',$verify['cnr_number'])->where('user_id',Auth::user()->id)->get();
				if(!empty($case)){
					$verify = $request->validate([
						'cnr_number' => 'unique:case_mast,cnr_number,'.$id.',case_id',
					]);
					
				}
				$data['cnr_number'] = $verify['cnr_number'];	
			}else{

				if($data['court_type'] == '3'){
						$verify = $request->validate([
							'state_code' => 'required|not_in:0',
							'city_code' => 'required|not_in:0',

						]);
						$data['state_code'] = $verify['state_code'];
						$data['city_code']  = $verify['city_code'];
					}
					else{
						$data['court_code'] 	= $request->court_code;
						$courts = CourtMast::where('court_code',$request->court_code)->first();
						$data['court_name'] = $courts->court_name;
					}
						$verify = $request->validate([
							'case_type_id' 	=> "required|not_in:0",
							'c_d_number' 	=> "required|string|min:1|max:5",
						],
						[
							'c_d_number.required' => 'The case number field is required.',
							'c_d_number.max' => 'The case number may not be greater than 4 characters.',
						]);
						$data['c_d_flag']		= 'c';
						$data['c_d_number'] 	= $verify['c_d_number'];
						$data['case_type_id'] 	= $verify['case_type_id'];
			}
		}
		

		if($request->affidavit_status == '1'){
			$verify = $request->validate([
					'affidavit_date' => 'required|date_format:Y-m-d',
				]);
			$data['affidavit_date'] = $verify['affidavit_date'];
		}
		if($data['case_status'] != 'cr'){
			$verify = $request->validate([
				'case_over_date' => 'required|date_format:Y-m-d',
			]);
			$data['case_over_date'] = $verify['case_over_date'];
		}
		$categories = CatgMast::where('catg_code',$data['catg_code'])->first(); 
		$subcategories = SubCatgMast::where('subcatg_code',$data['subcatg_code'])->first(); 

		$data['subcatg_desc'] =  $subcategories->subcatg_desc;
		$data['catg_desc']    = $categories->catg_desc;

		$data['user_id'] = Auth::user()->id;

		return $data;
	} 

	public function cases_table(){
		$case_status = request()->case_status;
		$cust_id = request()->cust_id;
		$client_ids = Helpers::deletedClients();
		$id =Auth::user()->id;
		if($cust_id == ''){		
			
			$cases = CaseLawyer::with(['member','case' => function($query)use($case_status,$cust_id){
				$query->with(['client','court','casetype'])->where('case_mast.case_status',$case_status);
			}])->where('user_id1',$id)->where('deallocate_date',null)->get();

			
			$page_name = 'case_diary';
				
		}
		else{
			$cases = CaseLawyer::with(['member','case' => function($query)use($case_status,$cust_id){
				$query->with(['client','court','casetype'])->where('cust_id',$cust_id)->where('case_mast.case_status',$case_status);;
			}])->where('user_id1',$id)->where('deallocate_date',null)->get();
			$page_name = 'clients';
		}
		return view('case_management.case.case_table',compact('cases','case_status','page_name'));
	}
	public function case_details($case_id){
	
		$case = CaseMast::with('casetype','client','court','state','city')
			->with(['members.member'])		
	       	->where('case_id', $case_id)
	        ->first();
	      
		return view('case_management.case.case_details',compact('case','page_name'));
	}
}
