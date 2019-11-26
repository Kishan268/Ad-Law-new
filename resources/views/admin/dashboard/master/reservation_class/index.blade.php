@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Reservation Class({{count($reservations)}}) <a href="{{route('reservation.create')}}" class="btn btn-sm btn-primary pull-right">Add Reservation Class</a></h3>
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
									<th>Reservation Class</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>	
								@php $count = '0' @endphp								
								@foreach($reservations as $reservation)
									<tr>
										<td>{{$reservation->id}}</td>
										<td>{{$reservation->name}}</td>
										<td>
											<form action="{{route('reservation.destroy', ['id' =>  $reservation->id ])}}" method="POST" id="delform_{{ $reservation->id }}">
											@method('DELETE')

										 	<a href="{{route('reservation.edit',$reservation->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="javascript:$('#delform_{{ $reservation->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
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