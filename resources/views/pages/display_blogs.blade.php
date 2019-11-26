@extends('layouts.default')
@section('content')
{{-- {{request()->route('data')}} --}}

 <div class="container mt-2">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">
        <!-- Title -->
        
        <h2 class="mt-4 text-justify">{{$blog->title}}</h2>
         <hr>
        <!-- Author -->
      {{--  <p>Posted on {{date('M-d-Y', strtotime($blog->created_at))}}</p> --}}
       <p> Posting On
       @php
           $date= date('M-d-Y', strtotime($blog->created_at));
           echo  str_replace('-', ',' ,$date);
       @endphp
       </p>


        <!-- Preview Image -->
      <div class="img-hover-zoom">
        @if($blog->image_url !='')         
          <img class="img-fluid rounded" src="{{ asset('/storage/app/public/blogs/'.$blog->image_url) }}" alt="" style="width: 900px;height: 300px">         
        @else
           <img class="img-fluid rounded" src="{{ asset('/storage/app/public/blogs/blog_default.png') }}" alt="" style="width: 900px;height: 300px">    
        @endif
      </div>
       <hr>
       @php
       echo $blog->body
       @endphp
 

      </div>


      @include('pages.articles_sidebar')

      </div>

    </div>


  </div>
<br>
@endsection