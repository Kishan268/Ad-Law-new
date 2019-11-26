@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Payment Mode <a href="{{route('payment_mode.create')}}" class="btn btn-sm btn-primary pull-right">Add Payment Mode</a></h3>
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
									<th>Payment Mode Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>	
								@php $count = '0' @endphp								
								@foreach($payment_modes as $payment_mode)
									<tr>
										<td>{{$payment_mode->id}}</td>
										<td>{{$payment_mode->name}}</td>
										<td>
											<form action="{{route('payment_mode.destroy', ['id' =>  $payment_mode->id ])}}" method="POST" id="delform_{{ $payment_mode->id }}">
											@method('DELETE')

										 	<a href="{{route('payment_mode.edit',$payment_mode->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="javascript:$('#delform_{{ $payment_mode->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

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