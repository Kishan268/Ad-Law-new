@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12 m-auto">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3>Blog Detail <a href="{{route('blog.index')}}" class="btn btn-sm btn-info pull-right">Back</a>
						</h3>					
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12" >
							<h2 class="text-capitalize">{{$blog->title}}</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4 class="">By <span class="text-primary">{{'Admin'}}</span></h4>

							<hr class="m-2">
							<h4 class="d-flex">Posted on <span class="text-muted">{{date('M d, Y', strtotime($blog->created_at))}} at {{date('h:i A', strtotime($blog->created_at))}}</span></h4>
							<hr >
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center" >
						@if($blog->image_url!= null)
							<img src="{{asset('storage/app/public/blogs/'.$blog->image_url)}}" style="width: 100%;height: 300px;">
							<hr class="m-2">
						@else
							<img src="{{asset('storage/app/public/blogs/blog_default.png')}}" style="width: 100%;height: 300px;">
							<hr>
						@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="font-size: 18px;" >
							@php echo $blog->body @endphp
						</div>					
					</div>		
				</div>
			</div>
		</div>
	</div>
</section>
@endsection