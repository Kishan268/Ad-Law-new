<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Todo;
use App\Models\Team;
use App\Models\UserTodo;
use App\Models\CaseMast;
use App\Helpers\Helpers;
class TodosController extends Controller
{
    public function index(){
        $id =Auth::user()->id;
        $todos = UserTodo::with(['todos' => function($query){
                $query->with(['users' => function($query){
                         $query->with('user');
                }]);
           }])->where('user_id',$id)->get();
          
        $todoCategory = '1';
        // return $todos;       
    	return view('todos.index',compact('todos','todoCategory','parent_id'));
    }
    public function create(){
        $client_ids = Helpers::deletedClients();
        $id =Auth::user()->id;
        $cases = CaseMast::with('casetype','client')
                        ->where('case_mast.user_id',$id)
                        ->where('case_mast.case_status','cr')
                        ->whereNotIn('cust_id',$client_ids)
                      ->get();
    	return view('todos.create',compact('cases'));
    }
    public function store(Request $request){
     
    	$request->validate([
    		'title' 		=> 'required|max:100',
    		'description' 	=> 'required|max:191',
    		'start_date'	=> 'required',
    		'end_date'		=> 'required',
    		'case_id1'		=> 'required',
    		
    	]);
        
		$data = [
				'title'			=> $request->title,
				'description'	=> $request->description,
				'start_date'	=> $request->start_date,
				'end_date'		=> $request->end_date,
				'case_id'		=> $request->case_id1 == "0" ? null : $request->case_id1,
				'user_id'		=> Auth::user()->id,
				]; 

        $verify = $request->validate([
            'users_id'      => 'required',
        ]);
      
    	$todo = Todo::create($data);
        $todo->todo_assign()->sync($verify['users_id']);
        
 
        if($request->page_name == 'todo'){
            return redirect()->route('todos.index')->with('success','To-dos created successfully');
        }
        else{

    	   return redirect()->back()->with('success','To-dos created successfully');
        }
    	
    }
    public function show($id){
    	$todoFind = Todo::find($id);
    	$team_id = $todoFind->team_id;
    	$todos = Todo::where('id',$id)->get();
    	if($team_id == Auth::user()->id){
    		$todoCategory = '1';
    	}
    	else{
    		$todoCategory = '0';
    	}
	
		return view('todos.index',compact('todos','todoCategory'));


    }
    public function todoTableChange(Request $request){
    	$todo = $request->todo;

    	$id =Auth::user()->id;
    	if($todo == '1'){
            $todos = UserTodo::with(['todos' => function($query){
                    $query->with(['users' => function($query){
                             $query->with('user');
                    }]);
               }])->where('user_id',$id)->get();
    	}
    	else{
    		$todos = Todo::with('user')->where('user_id',Auth::user()->id)->where('team_id','!=', Auth::user()->id)->get();
    	}
    
    	return view('todos.todo_table',compact('todos'));
    }
    // public function create_form(){
    //     $client_ids = Helpers::deletedClients();
    //     $id =Auth::user()->id;
    //     $cases = CaseMast::with('casetype','client')
    //                         ->where('case_mast.user_id',$id)
    //                         ->where('case_mast.case_status','cg')
    //                         ->whereNotIn('cust_id',$client_ids)
    //                         ->get();

    //     $members = User::where('parent_id',$id)->where('status','A')->get();
    //     return view('forms.todo.create',compact('members','cases'));
    // }
}
