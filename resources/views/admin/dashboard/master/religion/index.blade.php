@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Religion({{count($religions)}}) <a href="{{route('religion.create')}}" class="btn btn-sm btn-primary pull-right">Add Religion</a></h3>
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
									<th>Religion Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>	
								@php $count = '0' @endphp								
								@foreach($religions as $religion)
									<tr>
										<td>{{$religion->id}}</td>
										<td>{{$religion->name}}</td>
										<td>
											<form action="{{route('religion.destroy', ['id' =>  $religion->id ])}}" method="POST" id="delform_{{ $religion->id }}">
											@method('DELETE')

										 	<a href="{{route('religion.edit',$religion->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="javascript:$('#delform_{{ $religion->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
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