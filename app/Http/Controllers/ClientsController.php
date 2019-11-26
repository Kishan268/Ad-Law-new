<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\Customer;
use App\Models\CaseMast;
use App\Helpers\Helpers;
use App\Models\CaseStatusMast;
class ClientsController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
      $client_ids = Helpers::deletedClients();       
      $clients = Customer::where('user_id',Auth::user()->id)
                          ->whereNotIn('cust_id',$client_ids)
                          ->where('status_id','A')
                          ->paginate(10);

      return  view('clients.index',compact('clients'));
      
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $status_types    = Status::get();
      $cust_types = DB::table('cust_type_mast')->get();
      $states     = State::where('country_code',102)->get();
      $city = City::all();
      return view('clients.create', compact('status_types','cust_types','states','city'));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->client_validation($request);
        // return $data;


        if($request->cust_type_id==1){
          $validate = $request->validate(['gender'=>'required|not_in:0']);
          $data['gender'] = $request->gender;
          Customer::insert($data);
            return redirect()->route('clients.index')->with('success','Client Added Successfully');
        
        }
        else{
          $validate = $request->validate(['company_name'=>'required|max:255|string']);
          $data['company_name'] = $validate['company_name'];
             Customer::insert($data);
            return redirect()->route('clients.index')->with('success','Client Added Successfully');  
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
      $client = Customer::where('cust_id',$id)->first();
      $case_status = CaseStatusMast::all();
      return  view('clients.show',compact('client','case_status'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $status_types    = Status::get();
        $cust_types = DB::table('cust_type_mast')->get();
        $states     = State::where('country_code',102)->get();
        $client = Customer::where('cust_id', $id)->first();

        return view('clients.edit',compact('status_types','cust_types','states', 'client'));

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

      

      $data = $this->client_validation($request);

       if(Request()->cust_type_id==1)
        {

          $validate = $request->validate(['gender'=>'required|not_in:0']);
          $data['gender'] = $request->gender;
          $data['company_name'] = null;
          Customer::where('cust_id',$id)->update($data);
          return redirect()->route('clients.index')->with('success','Client Updated Successfully');  
        }
        else{
          $validate = $request->validate(['company_name'=>'required|max:255|string']);
          $data['company_name'] = $validate['company_name'];
          $data['gender'] = null;
          $data['dob'] = null;
          Customer::where('cust_id',$id)->update($data);
          return redirect()->route('clients.index')->with('success','Client Updated Successfully');
        }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
       
       Customer::where('cust_id',$id)->delete();
       return redirect()->route('clients.index')->with('success','Client Data Deleted Successfully');
    }
     public function client_validation($request){

       $data = $request->validate([
            'cust_name'   => 'required|string|max:255',
            'cust_type_id'=> 'required|not_in:0',
            'status_id'   => 'required|not_in:0',
            'regsdate'    => 'required|date_format:Y-m-d',
            'mobile1'     => 'required|string|max:10|min:10',
            'email'       => 'nullable|email',
            'dob'         => 'nullable|before:5 years ago|date_format:Y-m-d',
            'mobile2'     => 'nullable|string|max:11|min:10',
            'country_code'=> 'required',
            'state_code'  => 'required|not_in:0',
            'city_code'   => 'required|not_in:0',
            'adharno'     => 'nullable|string|max:12|min:12',
            'panno'       => 'nullable|string|max:11|min:9',
            'gstno'       => 'nullable|string|max:15|min:10',
            'tele'        => 'nullable|string|max:15|min:10',
            'user_id'     => 'required',
            // 'countfield'  => 'required',
            // 'p_name.*'    => 'nullable',
            // 'p_email.*'   => 'nullable',
            // 'p_mobile.*'  => 'nullable',
            // 'p_designation.*'=> 'nullable',
           
            
        ]
      );

        $state  = State::select('state_name')->where('state_code', $request->state_code)->first();
        $city = City::select('city_name')->where('city_code',$request->city_code)->first();
        $status = Status::select('status_desc')->where('status_id', $request->status_id)->first();
        $cust_types = DB::table('cust_type_mast')->select('cust_type_name')->where('cust_type_id',$request->cust_type_id)->first();

         $user_name = User::select('name')->where('id',$request->user_id)->first();

          $data['name'] = $user_name->name;
          $data['state_name'] = $state['state_name'];
          $data['city_name']  = $city['city_name'];
          $data['status_desc'] = $status['status_desc'];
          $data['cust_type_name'] =$cust_types->cust_type_name;
          $data['country_name'] ='India';
          $data['custaddr'] = $data['city_name']. ','. $data['state_name']. ','. $data['country_name'] ;

          return $data;


    }

  // public function view_return($lawyer_view, $lawcompany_view){
  //   $catgId = Auth::user()->user_catg_id;

  //     switch ($catgId) {
  //       case '2':
  //           return $lawyer_view;
  //         break;
  //       case '3': 
  //             return $lawcompany_view;
  //       default:
  //             return view('error_pages.403page');
  //         break;
  //     }
  //  }
}

