<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Models\CaseNotes;
use App\Models\CaseDetail;
use App\Models\CaseLawyer;
class CaseHearingController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function create(){
		$id = explode(',', request()->case_id);
		$case_id = $id[0];
		$page_name = $id[1];
		$case = CaseMast::find($case_id);

		$assign_mem = CaseLawyer::with('member')->where('deallocate_date',null)->where('case_id',$id)->get();
	
		return view('case_management.case_hearing.create',compact('case','page_name','assign_mem'));
	}

	public function store(Request $request){
		$data = $this->validation($request);
		$data['lawyer_names'] = json_encode($data['lawyer_names']);
		$data['judges_name'] = json_encode($data['judges_name']);

		
		$prev_hearing = CaseDetail::where('case_id',$data['case_id'])->get();

		if(count($prev_hearing) !=0){
			$end_array = $prev_hearing[sizeof($prev_hearing) - 1];
			$end_date = $end_array->hearing_date;
			$end_seq_no = $end_array->seq_no +1;
			
			
			$data['seq_no'] = $end_seq_no;

			if($end_date > $data['hearing_date']){
				$request->validate([
					'hearing_date' => 'after:'.$end_date,
				],
				[
					'hearing_date.after' => 'hearing date must be unique case last hearing date: '.$end_date,
				]);
			}

		}
		else{
			$data['seq_no'] = '1';
		}
		$case =CaseMast::find($data['case_id']); 
		$data['cust_id'] = $case->cust_id;
		
		CaseDetail::create($data);
		if($request->page_name == 'calendar'){
			return redirect()->back()->with('success', 'Case Hearing Inserted Successfully');
		}
		else{
			return redirect()->route('case_mast.show', $data['case_id'].','.$request->page_name)->with('success', 'Case Hearing Inserted Successfully');
		}
		
	}

	public function show($id){
		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_hearings = CaseDetail::where('case_id',$case_id)->get();

		return view('case_management.case_hearing.show',compact('case_hearings','page_name','case_id'));
	}

	public function edit($id){

		$id = explode(',', $id);
		$case_tran_id = $id[0];
		$page_name = $id[1];

		$case_hearing = CaseDetail::find($case_tran_id);

		$lawyer_ids = json_decode($case_hearing->lawyer_names);

		$judges_name = json_decode($case_hearing->judges_name);


		$assign_mem = CaseLawyer::with('member')->where('deallocate_date',null)->where('case_id',$case_hearing->case_id)->get();

		return view('case_management.case_hearing.edit',compact('case_hearing','assign_mem','page_name','lawyer_ids','judges_name'));

	}  

	public function update(Request $request ,$id){
		
		$data = $this->validation($request);
		$data['lawyer_names'] = json_encode($data['lawyer_names']);
		$data['judges_name'] = json_encode($data['judges_name']);

		$case_hearing = CaseDetail::find($id);
		// return $case_hearing->hearing_date;
		if($case_hearing->hearing_date != $data['hearing_date'] ){
			$prev_hearing = CaseDetail::where('case_id',$data['case_id'])->get();
			if(count($prev_hearing) !=0){
				$end_array = $prev_hearing[sizeof($prev_hearing) - 1];
				$end_date = $end_array->hearing_date;
				if($end_date > $data['hearing_date']){
					$request->validate([
						'hearing_date' => 'after:'.$end_date,
					],
					[
						'hearing_date.after' => 'hearing date must be unique case last hearing date: '.$end_date,
					]);
				}
			}
		}
		
		CaseDetail::where('case_tran_id',$id)->update($data);
		
		return redirect()->route('case_mast.show', $request->case_id.','.$request->page_name)->with('success', 'Case Hearing Updated Successfully'); 
		

	}
	public function destroy($id){

	CaseDetail::where('case_tran_id',$id)->delete();

	return redirect()->back()->with('success', 'Case Hearing Deleted Successfully');;


	}

	public function validation($request){
		$data= $request->validate([
			'case_id'          => 'required',
			'user_id'          => 'required',
			'hearing_date'     => 'required|date_format:Y-m-d|after_or_equal:today',
			'start_time'       => 'required',
			'lawyer_names'     => 'required',
			'judges_name'      => 'required',
			'hearing_notes'    => 'required',
		]);
		return $data;
	}
	
}
