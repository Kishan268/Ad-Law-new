@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xl-12 col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-6 col-xs-12 ">
							<h3 class="box-title">Add Appointment Schedule</h3>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12 text-right"> 
							<a class="btn btn-info btn-sm text-white" id="submit">Submit</a>
							<a href="{{route('appointment.index')}}" class="btn btn-sm btn-info">Back</a>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive ">
					<div id="demo"></div>
					<table class="table table-bordered	table-striped " id="thetable" >
						<thead class=" text-center" >
							<tr>
									<th></th>
								@foreach($days as $day)
									<th class="text-uppercase" id="{{$day->day}}">{{$day->day}}</th>
								@endforeach
							</tr>
						</thead>
						<tbody class="text-center">
						

							
						@foreach($slots as $slot)
							
							<tr>
							  <td>{{date('h:i A', strtotime($slot->slot))}}</td>
								@foreach($days as $day) 
									@php  $checked='';
											$plan_id = '';
									 @endphp
									@foreach($plans as $plan)
										@php

											if($day->id == $plan->day && $slot->slot == $plan->slot){
												$checked = "checked";
												$plan_id = $plan->id;
											}
										@endphp
									@endforeach
								<td>
									<label class="btn border border-success law_checkbox" id="" style="width:39px; height:39px; padding:0px">
										<input type="checkbox" id="{{ $plan_id }}"  class ="id_plan" name="{{$day->day}}" value="{{$slot->slot}}" style="width:39px; height:38px" {{ $checked }}>
										
										<i class="itag" id="itag"></i>
									</label>
								</td>
									@php $checked = ""; @endphp
								@endforeach
									
								
							</tr>
						@endforeach
				
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
	$.ajaxSetup({
	  headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$('#submit').on('click',function(e){
		e.preventDefault();
		var mon_slots_ids = [];
		var mon_plans_ids = [];
		$.each($("	input[name='Mon']:checked"),function(){
			mon_slots_ids.push($(this).val());
			mon_plans_ids.push($(this).attr('id'));

		});
		var tue_slots_ids = [];
		var tue_plans_ids = [];
		$.each($("	input[name='Tue']:checked"),function(){
			tue_slots_ids.push($(this).val());
			tue_plans_ids.push($(this).attr('id'));
		});
		var wed_slots_ids = [];
		var wed_plans_ids = [];
		$.each($("	input[name='Wed']:checked"),function(){
			wed_slots_ids.push($(this).val());
			wed_plans_ids.push($(this).attr('id'));
		});
		var thu_slots_ids = [];
		var thu_plans_ids = [];
		$.each($("	input[name='Thu']:checked"),function(){
			thu_slots_ids.push($(this).val());
			thu_plans_ids.push($(this).attr('id'));
		});
		var fri_slots_ids = [];
		var fri_plans_ids = [];
		$.each($("	input[name='Fri']:checked"),function(){
			fri_slots_ids.push($(this).val());
			fri_plans_ids.push($(this).attr('id'));
		});
		var sat_slots_ids = [];
		var sat_plans_ids = [];
		$.each($("	input[name='Sat']:checked"),function(){
			sat_slots_ids.push($(this).val());
			sat_plans_ids.push($(this).attr('id'));
		});
		var sun_slots_ids = [];
		var sun_plans_ids = [];
		$.each($("input[name='Sun']:checked"),function(){
			sun_slots_ids.push($(this).val());
			sun_plans_ids.push($(this).attr('id'));
		});
		var plans_id = $.merge( mon_plans_ids, tue_plans_ids, wed_plans_ids, thu_plans_ids, fri_plans_ids, sat_plans_ids, sun_plans_ids)

		$.ajax({
			type:'PUT',
			url: "{{route('appointment.update', ['id'=> Auth::user()->id])}}",
			data: {mon_slots_ids:mon_slots_ids,tue_slots_ids:tue_slots_ids,wed_slots_ids:wed_slots_ids,thu_slots_ids:thu_slots_ids,fri_slots_ids:fri_slots_ids,sat_slots_ids:sat_slots_ids,sun_slots_ids:sun_slots_ids},
			success:function(data){
				if(data!="no"){

					swal({
	                  text: data,
	                  icon : 'success',
	                });
				 	setTimeout(function(){ // wait for 5 secs(2)
	                   window.location.href = "<?php echo URL::to('/appointment'); ?>"; // then reload the page.(3)
	                }, 3000); 
	           
	  		
				}
				else{
					swal({
	                  text: "Please Select Appointment Schedule",
	                  icon : 'warning',
	                });
				 	setTimeout(function(){ // wait for 5 secs(2)
	              		location.reload();
	                }, 3000);
				}
			}
		});



	});

});

</script>

@endsection
