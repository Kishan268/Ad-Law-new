<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->user_catg_id ==2){
                return redirect('/lawfirm');
            }
            else if(Auth::user()->user_catg_id ==3){
                return redirect('/lawfirm');
            }
            else if(Auth::user()->user_catg_id ==4){
                return redirect('/lawschools');
            }
            else if(Auth::user()->user_catg_id ==5){
             return redirect('/customer');
            }
            else if(Auth::user()->user_catg_id ==6){
             return redirect('/lawschools');
            }
            else if(Auth::user()->user_catg_id ==7){
             return redirect('/lawschools');
            }
            else if(Auth::user()->user_catg_id ==1){
             return redirect('/admin');
            }
               
        }

        return $next($request);
     }
    
}
