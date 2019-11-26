@extends('layouts.default')
@section('content')

<div class="container mt-2">
<div class="row">
	<div class="col-md-8 col-sm-8 col-lg-8 col-xs-12 p-2">

		@foreach($all_articles as $articles)
		<div class="row border mb-2 ml-1 mr-1" style="background: #f6f6f6;">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-9 blog_title">
						<a href="{{ url('/display_blogs/'.$articles->slug) }}" class="text-decoration-none"><h4>{{$articles->title}}</h4></a>
					</div>
					<div class="col-md-3 pr-0 blog_date"><h4 style="font-size: 16px;" class="">{{ date('M d, Y', strtotime($articles->created_at)) }}</h4></div>
				</div>
				<div class="row">
					<div class="col-md-4 mt-2">
						<div class="img-hover-zoom">
						@if($articles->image_url!='')         
							<img class="rounded" src="{{ asset('/storage/app/public/blogs/'.$articles->image_url) }}" alt="" style="width: 221px;height: 123px">         
						@else
							<img class="rounded" src="{{ asset('/storage/app/public/blogs/blog_default.png') }}" alt="" style="width: 221px;height: 123px">  
						@endif  
						</div>      
					</div>
					<div class="col-md-8 mt-2">
						<div class="row">
							<div class="col-md-12 ">
								@php
									echo str_limit($articles->body, $limit=202, $end='...') 
								@endphp 
							</div>
							<div class="col-md-12 pull-right">
								<a class="btn btn-sm btn-primary" href="{{ url('/display_blogs/'.$articles->slug) }}"> Readmore </a>
							</div>
						</div>
						
					</div>
				</div>
				<br>
			</div>
			
		</div>
		@endforeach
		<p> {{$all_articles->links()}}</p>

	</div>
	<!-- start articles_sidebar blog-->
@include('pages.articles_sidebar')
<!-- end articles_sidebar blog-->

</div>
</div>
<br>
@endsection