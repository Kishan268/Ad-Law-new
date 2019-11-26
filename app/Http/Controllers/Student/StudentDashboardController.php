<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
class StudentDashboardController extends Controller
{
    public function index(){
    	
    	return view('student.index');
    }
    public function upload_student(){
    	return view('student.upload_student.index');
    }
    public function importStudent(Request $request){
    	 $this->validate($request,[
                'file' => 'required|mimes:xls,xlsx',
        ]);


        $datas = Excel::toCollection(new StudentsImport,$request->file('file'));
        return $datas;
    }

}
