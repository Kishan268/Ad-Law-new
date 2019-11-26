@extends('customer.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Appointment</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-stripped table-bordered" id="myTable">
						<thead>
							<tr>
								<td>SNo.</td>
								<td>Lawyer Name</td>
								<td>Bopking Time</td>
								<td>Booking Date</td>
								<td>Booking Status</td>
							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							@foreach($bookings as $booking)
							<tr>
								<td>{{++$count}}</td>
								<td>{{$booking->name}}</td>
								<td>{{date('h:i A',strtotime($booking->slot))}}</td>
								<td>{{date('d-m-Y',strtotime($booking->b_date))}}</td>
								<td>
								@if($booking->client_status==1 && $booking->user_status==0)
									<p class="text-primary">{{'Pending'}}</p>
								@elseif($booking->client_status==1 && $booking->user_status==1)
									<p class="text-success">{{'Booked'}}</p>
								@else
									<p class="text-danger">{{'Cancelled'}}</p>
								@endif
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