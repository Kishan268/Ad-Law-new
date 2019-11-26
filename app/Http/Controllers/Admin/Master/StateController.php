<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::with('country')->get();
        $countries = Country::all();
       

        return view('admin.dashboard.master.location.state.index',compact('states','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.dashboard.master.location.state.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =$this->validation($request);
        $states = State::all();
        if(count($states) !=0){
            foreach ($states as $value) {
                $data['state_code'] = $value->state_code +1;
            }
        }
        else{
            $data['state_code'] = '1';
        }
        
        State::create($data);
        return redirect()->route('state.index')->with('success', 'State Insterted Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $state = State::find($id);
        return view('admin.dashboard.master.location.state.edit',compact('countries','state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data  = $this->validation($request);
        $state = State::find($id);
        $state->update($data);
        return redirect()->route('state.index')->with('success', 'State Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::find($id)->delete();
        return redirect()->back()->with('success', 'State Deleted Succesfully');
    }
    public function validation($request){
        return $request->validate([
            'country_code'  => 'required|not_in:0',
            'state_name'    => 'required|string|max:45|min:3',
        ]);
    }
    public function countryFilter(Request $request){

      
        $states = State::where('country_code',$request->country_code)->get();

        return view('admin.dashboard.master.location.state.table',compact('states'));
    }
}
