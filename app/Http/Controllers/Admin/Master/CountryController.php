<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Nationality;

class CountryController extends Controller
{
 
    public function index()
    {
        $countries = Country::all();
        return view('admin.dashboard.master.location.country.index',compact('countries'));
    }

  
    public function create()
    {
       
        return view('admin.dashboard.master.location.country.create');
    }
 
    public function store(Request $request)
    {
        $data = $this->validation($request);
        $countries = Country::all();

        if(count($countries) !=0){
            foreach ($countries as $value) {
                $data['country_code'] =  $value->country_code + 1 ;
            }
        }
        else{
            $data['country_code'] = '1';
        }

        Country::create($data);
        return redirect()->route('country.index')->with('success','Country Name Inserted Successfully');
    }

   
    public function edit($id)
    {
        $country = Country::find($id);
       
        return view('admin.dashboard.master.location.country.edit',compact('country'));
    }

 
    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $country = Country::find($id); 
        $country->update($data);
        return redirect()->route('country.index')->with('success','Country Name Updated Successfully');
    }

    
    public function destroy($id)
    {
        $country = Country::find($id)->delete();
        return redirect()->back()->with('success','Country Name Deleted Successfully');
    }

    public function validation($request){
        return $request->validate([
            'country_name'  => 'required|string|max:80|min:3',
             'phone_code'   => 'nullable|string|max:10|min:1|regex:/^[0-9]+$/',
             'iso2'         => 'nullable|string|max:2|min:2',
             'iso3'         => 'nullable|string|max:3|min:3',
             'nationality'  => 'nullable|string|max:25|min:1',
             'currency_code'=> 'nullable|min:2|max:6',
             'currency_name'=> 'nullable|min:1|max:25'
        ]);
    }
}
