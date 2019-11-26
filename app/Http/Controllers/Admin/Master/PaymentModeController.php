<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMode;
class PaymentModeController extends Controller
{
    public function index(){
    	$payment_modes = PaymentMode::all(); 
    	return view('admin.dashboard.master.payment_mode.index',compact('payment_modes'));
    }
    public function create(){
    	return view('admin.dashboard.master.payment_mode.create');
    }
    public function store(Request $request){

    	$data = $request->validate([
    		'name' => 'required|max:100|min:1',
    	]);

    	$payment_modes = PaymentMode::all(); 
    	if(count($payment_modes) !=0){
            foreach ($payment_modes as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

    	PaymentMode::create($data);
    	return redirect()->route('payment_mode.index')->with('success', 'Payment Mode Name  Inserted Successfully');
    }
    public function edit($id){
    	$payment_mode = PaymentMode::find($id);
    	return view('admin.dashboard.master.payment_mode.edit', compact('payment_mode'));
    }
    public function update(Request $request,$id){
     	$data = $request->validate([
    		'name' => 'required|max:100|min:1',
    	]);
     	PaymentMode::find($id)->update($data);
     	return redirect()->route('payment_mode.index')->with('success', 'Payment Mode Name Updated Successfully');
    }
    public function destroy($id){
    	PaymentMode::find($id)->delete();
    	return redirect()->back()->with('success', 'Payment Mode Name Deleted Successfully');
    }
}
