<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Models\CaseNotes;
use App\Models\CaseDoc;
use App\Models\DocTypeMast;
use App\Helpers\Helpers;
class CaseDocController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function create(){

		$id=Request()->case_id;
		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];

		$case_detail = CaseMast::where('case_id',Request()->case_id)->first();

		$doc_types=DocTypeMast::all();
		return view('case_management.case_doc.create', compact('case_detail','doc_types','page_name'));
	}

	public function store(Request $request){
		$data = $request->validate([
			'user_id' 	=>'required',
			'case_id' 	=>'required',
			'cust_id'	=>'required',
			'doc_remark'=>'required',
			'doc_type'	=>'required|not_in:0',

			'doc_name'	=>'required|mimes:jpeg,png,jpg,pdf,docx,doc,xlsx,txt|max:10240',

		]);	
		$file = $request->file('doc_name');
		$filename =  time().'_'.$file->getClientOriginalName();
		$path = $file->storeAs('public/document', $filename);
		$url = Storage::url('/document/'.$filename);
		// $size = Storage::size('public/document', $filename);
		$data['doc_name'] = $filename;	
		$data['doc_url'] = $url;
		$data['doc_size'] = Helpers::bytesToHuman($file->getSize());
		$extension = $request->doc_name->getClientOriginalExtension();

		CaseDoc::insert($data);

		
		return redirect()->route('case_mast.show', $data['case_id'].','.$request->page_name)->with('success', 'Case Document Inserted Successfully');
	}
	public function show($id){
		$id = explode(',', $id);
		$case_id = $id[0];
		$page_name = $id[1];
		$case_docs = CaseDoc::where('case_id',$case_id)->get();
		return view('case_management.case_doc.show',compact('case_docs','page_name','case_id'));
	}

	public function fileDownload(){

		$doc_detail = CaseDoc::where('doc_id', Request()->doc_id)->first();
		return Storage::download('/public/document/'.$doc_detail['doc_name']);
	}

	public function destroy($doc_id){

		CaseDoc::where('doc_id', $doc_id)->delete();
		return redirect()->back()->with('success','Case Document Deleted Successfully');

	}
}
