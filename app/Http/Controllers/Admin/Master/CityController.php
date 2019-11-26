<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities =City::with(['state','country'])->get();
        $states = State::all();
        return view('admin.dashboard.master.location.city.index',compact('cities','states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.dashboard.master.location.city.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);
        
        $cities = City::all();
        if(count($cities) !=0){
            foreach ($cities as $value) {
                $data['city_code'] = $value->city_code +1;
            }
        }
        else{
            $data['city_code'] = '1';
        }
  
        City::create($data);
        return redirect()->route('city.index')->with('success','City Name Inserted Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $countries = Country::all();
        return view('admin.dashboard.master.location.city.edit',compact('city','countries'));
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
        $data = $this->validation($request);
        $city = City::find($id);
        $city->update($data);
        return redirect()->route('city.index')->with('success','City Name Update Succesfully');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::find($id)->delete();
        return redirect()->back()->with('success','City Name Deleted Succesfully');
    }
    public function validation($request){
      return  $request->validate([
                     'country_code' => 'required|not_in:0',
                     'state_code'   => 'required|not_in:0',            
                     'city_name'    => 'required|string|max:85|min:3',
                     // 'latitude'     => 'nullable',
                     // 'longitude'    => 'nullable',
                ]);

    }
    public function cityfilter(Request $request){

        $cities =City::with(['state','country'])->where('state_code',$request->state_code)->get();

        return view('admin.dashboard.master.location.city.table',compact('cities'));
    }
}
