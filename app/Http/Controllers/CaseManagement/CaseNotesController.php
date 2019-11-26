<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Models\CaseNotes;
class CaseNotesController extends Controller
{
	public function create(){
		$id = explode(',',request()->case_id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_detail = CaseMast::where('case_id',$case_id)->first();
		return view('case_management.case_notes.create', compact('case_detail','page_name'));
	}

	public function store(Request $request){
		$data = $this->validation($request);
		$data['case_note_date'] = date('Y-m-d');
		CaseNotes::create($data);
	
		return redirect()->route('case_mast.show', $data['case_id'].','.$request->page_name)->with('success', 'Case Notes Inserted Successfully');
		
	}
	public function show($id){
		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_notes = CaseNotes::where('case_id', $case_id)->get();
		return view('case_management.case_notes.show',compact('case_notes','page_name','case_id'));

	}
	public function edit($id){
		$id = explode(',', $id);
		$notes_id = $id[0];
		$page_name = $id[1];
		$case_notes = CaseNotes::where('case_notes_id',$notes_id)->first();
		return view('case_management.case_notes.edit',compact('case_notes','page_name'));
	}

	public function update(Request $request, $notes_id){
		$data = $this->validation($request);
		CaseNotes::where('case_notes_id',$notes_id)->update($data);

		
		return redirect()->route('case_mast.show', $request->case_id.','.$request->page_name)->with('success', 'Case Notes Updated Successfully'); 
	
	}

	public function destroy($notes_id){
		CaseNotes::where('case_notes_id',$notes_id)->delete();

		return redirect()->back()->with('success', 'Case Notes Deleted Successfully');

	}

	public function validation($request){
		$data = $request->validate([
			'case_note_heading' => 'required|string|max:255',
			'case_notes_type' 	=> 'required|not_in:0',
			'case_notes' 		=> 'required|string',
			'cust_id' 			=> 'required',
			'case_id' 			=> 'required',
			'user_id'			=> 'required',
		]);
		return $data;
	}
}
