<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        $catgId = Auth::user()->user_catg_id;
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        switch ($catgId) {
            case '1' : $login = '/admin';
                break;
            case '2':
                return $login = '/lawfirm';
                break;
            case '3':
                return $login = '/lawfirm';
                break;
            case '4':
                return $login = '/lawschools';
                break;
            case '5':
                return $login = '/customer';
                break;
            case '6':
                return $login = '/lawschools';
                break;  
            case '7':
                return $login = '/lawschools';
                break;   
            default:
                return $login='/';
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : $login;
    }
    
    protected function authenticated(Request $request, $user)
    {
       $status = DB::table('status_mast')->select('*')->get();
       
       $result = json_decode(json_encode($status, true));
       foreach($result as $key => $value)
            {
                $result[$key] = (array) $value;
            }  

         if ($user->status == $result[0]['status_id']) {
          $url =  $this->redirectTo = url()->previous();
          $homeUrl =url('/').'/';      
          if($url == $homeUrl){

             return redirect()->intended($this->redirectPath());
          }
          else{
            return redirect()->intended($url);
          }
    
        }
        else{
            auth()->logout();
            return back()->with('warning',$result[1]['status_text']); 
        }
     }  
}
