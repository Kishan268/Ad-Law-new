@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12 col-sm-12 m-auto">
			<div class="box box-primary ">
     		 	<div class="box-header with-header">
					<h3 >All Blogs
					<a href="{{route('blog.create')}}" class="btn btn-sm btn-primary pull-right">Add New Blog</a></h3> 
				</div>
				<div class="box-body table-responsive"  >
					@if($message = Session::get('success'))
					<div class="alert bg-success">
						{{$message}}
					</div>
					@endif
					<table class="table table-striped table-bordered" id="myTable">
						<thead>
							<tr class="row">
								<th>SNo.</th>
								<th>Blog Title</th>
								<th>Image</th>
								<th>Created Date</th>
								<th>Status</th>
								<th>Edit</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							@foreach($blogs as $blog)
							<tr class="row">
								<td>{{ ++$count }}</td>
								<td>{{ $blog->title }}</td>
								<td><?php if($blog->image_url!=''){ echo explode('_',$blog->image_url,2)[1];  }
									else {
										echo "-";
									}
									 ?></td>
								<td>{{date('d-m-Y',strtotime($blog->created_at)) }}</td>
								<td>{{ $blog->b_status->status_desc }}</td>
								<td >
								
									<a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
								
								
								<form action="{{ route('blog.destroy',['id'=>$blog->id])}}" method="POST" id="delform_{{ $blog->id}}">
										@csrf
									@method('DELETE')
									<a href="javascript:$('#delform_{{ $blog->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white" style="font-size: 12px;"></i></a>
							
								</form>
								
								</td>
								<td><a href="{{route('blog.show', ['id'=>$blog->id])}}" class="btn btn-sm btn-success" >View</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
	<script >
		$(document).ready(function(){
			$('#myTable').DataTable();
		});
		
	</script>
@endsection