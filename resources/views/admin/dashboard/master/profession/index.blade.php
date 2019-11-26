@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Professions({{count($professions)}}) <a href="{{route('profession.create')}}" class="btn btn-sm btn-primary pull-right">Add Profession</a></h3>
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
								<th>Profession Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>	
							@php $count = '0' @endphp								
							@foreach($professions as $profession)
								<tr>
									<td>{{$profession->id}}</td>
									<td>{{$profession->name}}</td>
									<td>
										<form action="{{route('profession.destroy', ['id' =>  $profession->id ])}}" method="POST" id="delform_{{ $profession->id }}">
										@method('DELETE')

									 	<a href="{{route('profession.edit',$profession->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

									 	<a href="javascript:$('#delform_{{ $profession->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
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