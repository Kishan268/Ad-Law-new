@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12 m-auto">
		<div class="box box-primary">
			<div class="box-header " >
				<div class="row">
					<div class="col-md-12">
						<h3 style="margin-top: 10px;">Book an Appointment</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-sm btn-info" style="margin-top: 20px;" id="unbooked">Unconfirmed Appointment</button>
						<button class="btn btn-sm btn-secondary" style="margin-top: 20px;" id="booked">Confirmed Appointment</button>
						<button class="btn btn-sm btn-secondary" style="margin-top: 20px;" id="cancelled">Cancelled Appointment</button>
					</div>
				</div>
				
			</div>
			<div class="box-body table-responsive " >
				<div class="row">
					<div class="col-md-12 unbookedTable"> 
						@if($message = Session::get('success'))
							<div style="margin-top: 10px;" class="alert bg-success">
							{{$message}}
							</div>
						@endif
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Client Name</th>
								<th>Client Address</th>
								<th>Client Mobile Number</th>
								<th>Appointment Time</th>
								<th>Appointment Date</th>
								<th>Accept</th>
								<th>Cancelled</th>

							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							@foreach($unbookings as $booking)
							<tr>
								<td>{{++$count}}</td>			
								<td>{{$booking->name}}</td>	
								<td>{{$booking->city_name .', '. $booking->state_name}}</td>
								<td>{{$booking->mobile}}</td>		
								<td>@foreach($slots as $slot)
								{{$booking->plan_id == $slot->id ? date('h:i A', strtotime($slot->slot)) : ''}}
								@endforeach	
								</td>	
								<td>{{date('d-m-Y', strtotime($booking->b_date))}}</td>			
								<td>
									<a href="{{route('bookingUpdate',['id'=>$booking->id])}}" class="btn btn-sm btn-success" id="Accept">Accept</a>
								</td>	
								<td>
									<a href="{{route('bookingCancelled',['id'=>$booking->id])}}" class="btn btn-sm btn-danger" id="Accept">Cancelled</a>
								</td>		
							</tr>
							@endforeach
						</tbody>
						</table>
					</div>
					<div class="col-md-12 bookedTable" style="display: none;"> 
						<table class="table table-hover table-striped table-bordered" >
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Client Name</th>
								<th>Client Address</th>
								<th>Client Mobile Number</th>
								<th>Appointment Time</th>
								<th>Appointment Date</th>
								

							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							@foreach($booked as $book)
							<tr>
								<td>{{++$count}}</td>			
								<td>{{$book->name}}</td>	
								<td>{{$book->city_name .', '. $book->state_name}}</td>
								<td>{{$book->mobile}}</td>		
								<td>@foreach($slots as $slot)
								{{$book->plan_id == $slot->id ? date('h:i A', strtotime($slot->slot)) : ''}}
								@endforeach	
								</td>	
								<td>{{date('d-m-Y', strtotime($book->b_date))}}</td>			
							</tr>
							@endforeach
						</tbody>
						</table>
					</div>
						<div class="col-md-12 cancelledTable" style="display: none;"> 
						<table class="table table-hover table-striped table-bordered" >
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Client Name</th>
								<th>Client Address</th>
								<th>Client Mobile Number</th>
								<th>Appointment Time</th>
								<th>Appointment Date</th>
								

							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							@foreach($cancelled as $book)
							<tr>
								<td>{{++$count}}</td>			
								<td>{{$book->name}}</td>	
								<td>{{$book->city_name .', '. $book->state_name}}</td>
								<td>{{$book->mobile}}</td>		
								<td>@foreach($slots as $slot)
								{{$book->plan_id == $slot->id ? date('h:i A', strtotime($slot->slot)) : ''}}
								@endforeach	
								</td>	
								<td>{{date('d-m-Y', strtotime($book->b_date))}}</td>			
							</tr>
							@endforeach
						</tbody>
						</table>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
</div>
</section>

<script>
	$(document).ready(function(){
		$('.table').DataTable();

		$('#unbooked').on('click',function(){
			$('.bookedTable').hide();
			$('.cancelledTable').hide();
			$('.unbookedTable').show();

			$('#unbooked').addClass('btn-info');
			$('#booked').removeClass('btn-info');
			$('#cancelled').removeClass('btn-info');
		});
		$('#booked').on('click',function(){
			$('.bookedTable').show();
			$('.cancelledTable').hide();
			$('.unbookedTable').hide();

			$('#unbooked').removeClass('btn-info');
			$('#booked').addClass('btn-info');
			$('#cancelled').removeClass('btn-info');
			$('#unbooked').addClass('btn-secondary');


		});
		$('#cancelled').on('click',function(){
			$('.bookedTable').hide();
			$('.cancelledTable').show();
			$('.unbookedTable').hide();

			$('#unbooked').removeClass('btn-info');
			$('#booked').removeClass('btn-info');
			$('#cancelled').addClass('btn-info');
			$('#unbooked').addClass('btn-secondary');
		});
	});
</script>
@endsection