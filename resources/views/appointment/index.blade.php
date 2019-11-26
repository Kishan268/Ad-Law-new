@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border " >
				<h3 style="margin-top: 10px;">Appointment Schedule
					@if(count($plans)==0)				
						<a href="{{route('appointment.create')}}" class="btn btn-sm btn-primary pull-right">Add Appointment Schedule</a>		
					@else				
						<a href="{{route('appointment.edit', ['user_id'=>Auth::user()->id] )}}" class="btn btn-sm btn-primary pull-right">Edit Appointment Schedule</a>
					@endif
				</h3> 
			</div>
			<div class="box-body table-responsive " >
				@if($message = Session::get('success'))
					<div class="alert alert-success">
						{{$message}}
					</div>
				@endif
					<table class="table table-bordered	table-striped " id="thetable" >
					<thead class="text-center">
						<tr>
							<th></th>
							@foreach($days as $day)
							<th class="text-uppercase">{{$day->day}}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						
					@if(count($plans)!=0)
						@foreach($slots as $slot)
							<tr>
							  <td>{{ date('h:i A', strtotime($slot->slot)) }}</td>
								@foreach($days as $day) 
									@php  $checked=''; @endphp
									@foreach($plans as $plan)

										@php

											if($day->id == $plan->day && $slot->slot == $plan->slot){
												$checked = date('h:i A', strtotime($plan->slot));
											}
										@endphp
									@endforeach
							 
									@if($checked)
										<td class="text-center"><a class="btn btn-sm btn-success text-white">{{ $checked }}</a></td>
									@else
										<td></td>								
									@endif

									@php $checked = ""; @endphp
							
								@endforeach
									

							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
</section>
<script type="text/javascript">
$(document).ready(function(){
	$('#thetable').DataTable({
			 "order": false,
			"paging":   false,
			"scrollY": "300px",
			// "scrollCollapse": true,
		});
});
</script>
@endsection