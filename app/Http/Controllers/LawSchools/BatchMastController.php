<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BatchMast;
use Auth;

class BatchMastController extends Controller
{
    public function index(){
        $batches = BatchMast::where('user_id',Auth::user()->id)->orderBy('name','DESC')->get();
        return view('lawschools.dashboard.manage.batches.index',compact('batches'));
    }

    public function create()
    {
        return view('lawschools.dashboard.manage.batches.create');
        
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $batches = BatchMast::where('user_id',Auth::user()->id)->get();
        $data =  $request->validate([
            'start_date' =>'required',
            'end_date' =>'required',
        ]);
        foreach ($batches as $batch) {         
            if($batch->name == $request->name){
                return back()->withInput()->with('warning','Batch name already in records');
                 // return redirect()->route('warning','Batch name is already in records');

            }
                 
        }    

        $data['name']= $request->name;
        $data['user_id'] = $user_id;
        $batch = BatchMast::create($data);
        return redirect()->route('batches.index')->with('success','Batch Inserted Successfully');
        
           
    }

    public function edit($id)
    {
        $batch = BatchMast::find($id);        
        return view('lawschools.dashboard.manage.batches.edit',compact('batch'));

    }

    public function update(Request $request, $id)
    {
        
        $user_id    = Auth::user()->id;
        $batches    = BatchMast::where('user_id',Auth::user()->id)->get();
        $data       =  $request->validate([
                    'start_date' =>'required',
                    'end_date' =>'required',
        ]);
        foreach ($batches as $batch) {
            if($batch->id != $id){
                if($batch->name == $request->name){
                    return back()->withInput()->with('warning','Batch name already in records');
                }
            }        
        }    

        $data['name']= $request->name;       
        $data['user_id'] = $user_id;
        $batch = BatchMast::find($id)->update($data);

        return redirect()->route('batches.index')->with('success','Batch Updated Successfully');
    }

   
    public function destroy($id)
    {
        $batch_delete = BatchMast::find($id)->delete();
        return redirect()->route('batches.index')->with('success','Batch Deleted Successfully');  
    }

    // public function validation($request,$id){
    //     $batches = BatchMast::where('user_id',Auth::user()->id)->get();
    //     $data =  $request->validate([
    //         'start_date' =>'required',
    //         'end_date' =>'required',
    //     ]);
    //     foreach ($batches as $batch) {
    //         if($batch->id != $id){
    //             if($batch->name == $request->name){
    //                 return redirect()->back()->with('warning','Batch name is already inserted');
    //             }
    //         }        
    //     }    

    //     $data['name']= $request->name;
    //     return $data;
    // }
}
