<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\Blog;
use App\Models\Status;
use App\Models\BlogCatg;

class BlogController extends Controller
{
    public function index(){
       $blogs =  Blog::with('b_status')->where('author_id',Auth::user()->id)->get();
     
        return view('admin.dashboard.blog.show', compact('blogs'));
    }
    public function create(){
        $status=Status::all();
        $blog_catgs = BlogCatg::all();
        return view('admin.dashboard.blog.create',compact('status','blog_catgs'));
    }

    public function store(Request $request){
       
        $data = $this->blogvalidation($request);
           $data['created_at'] = $data['created_at'].' '. date('h:i:s');
           
        $image = request()->validate([
          'image_url' => 'nullable|mimes:jpeg,png,jpg|max:10240',
         ]);
        
        if($request->image != ''){
            $file=$image;
            $file = $request->file('image_url');
            $filename =  time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('public/blogs', $filename);
            $data['image_url'] = $filename;

        }
        else{
            $data['image_url'] = null;
        }
        if($request->created_at ==''){
            $data['created_at'] = date('Y-m-d h:i:s');
        }
        
        Blog::create($data);   
        return redirect()->route('blog.index')->with('success','Blog Created successfully');
    } 
    public function show($id){
        $blog = Blog::find($id);
        return view('admin.dashboard.blog.blog_detail',compact('blog'));
    }   
    public function blogvalidation($request){

    	$data= $request->validate([
            'author_id' => 'required',
            'title'     => 'required|string|min:5|max:255',
            'slug'      => 'required|string|min:5|max:255',
            'body'      => 'required|string',
            'status'    => 'required',
            'created_at'=> 'nullable',
            'catg_code' => 'required|not_in:0'

        ]);
         return $data;
    }
    public function edit($id){
        
        $status=Status::all();
        $blog = Blog::find($id);
        $blog_catgs = BlogCatg::all();
        return view('admin.dashboard.blog.edit',compact('status', 'blog','blog_catgs'));

    }
    public function update(Request $request, $id){

        $blog =Blog::where('id',$id)->first(); 
        $oldFile = $blog->image_url;
     

        $data = $this->blogvalidation($request);

        if($request->image_url != null ){
            $image = request()->validate([
              'image_url' => 'nullable|mimes:jpeg,png,jpg|max:10240',
             ]);
            
            
            $file= $image;
            $file = $request->file('image_url');
            $filename =  time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('public/blogs', $filename);

            Storage::delete('public/blogs/'.$oldFile);

            $data['image_url'] = $filename;

        } 
        else{
            $data['image_url'] =$oldFile ;
        }
        if($request->created_at ==''){
            $data['created_at'] = date('Y-m-d h:i:s');
        }

        Blog::where('id',$id)->update($data);
        return redirect()->route('blog.index')->with('success','Blog updated successfully');


    }   
    public function destroy($id){
        $blog =Blog::where('id',$id)->first(); 
        $oldFile = $blog->image_url;

       Blog::where('id',$id)->delete();
        
       Storage::delete('public/blogs/'.$oldFile);

       return redirect()->back()->with('success','Blog deleted successfully');
    }


    public function show_blogs($slug)
    {
         $blog = Blog::where('id', $slug)
            ->orWhere('slug', $slug)
            ->firstOrFail();
            return view('pages.display_blogs',compact('blog'));
    
    }
    public function more_articles(Request $request)
    {
         $all_articles =Blog::paginate(5);
         return view('pages.more_articles',compact('all_articles'));
    }


}