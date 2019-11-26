@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Designation ({{count($designations)}}) <a href="{{route('designation.create')}}" class="btn btn-sm btn-primary pull-right">Add Designation</a></h3>
				</div>
				<div class="box-body">
					@if($message = Session::get('success'))
						<div class="alert bg-success">
							{{$message}}
						</div>
					@endif
					<table class="table table-striped table-bordered" id="myTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Designation Name</th>
								<th>Short Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>	
							@php $count = '0' @endphp								
							@foreach($designations as $designation)
								<tr>
									<td>{{$designation->id}}</td>
									<td>{{$designation->name}}</td>
									<td>{{$designation->shrt_desc}}</td>
									<td>
										<form action="{{route('designation.destroy', ['id' =>  $designation->id ])}}" method="POST" id="delform_{{ $designation->id }}">
										@method('DELETE')

									 	<a href="{{route('designation.edit',$designation->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

									 	<a href="javascript:$('#delform_{{ $designation->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
									 	@csrf
										</form>
									</td>
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