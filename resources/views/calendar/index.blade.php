@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<div id="calendar"></div>
					<br>
					<div class="row">
						<div class="col-md-12 text-center">
							<label><i class="fa fa-square" style="color: #ff4566; height: 25px;width: 20px;"></i> Member To-dos</label>
							<label><i class="fa fa-square" style="color: #fda503; height: 25px;width: 20px;"></i> Everyone To-dos</label>
							<label><i class="fa fa-square" style="color: #8259ff; height: 25px;width: 20px;"></i> Hearing Morning Session</label>
							<label><i class="fa fa-square" style="color: #0cab0a; height: 25px;width: 20px;"></i> Hearing Evening Session</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	@include('calendar.calendar_modal')
</section>
 <script>
 @if($message = Session::get('success'))
 	alert("{{$message}}");
 @endif
	$(document).ready(function() {
	// page is now ready, initialize the calendar...
	$('#calendar').fullCalendar({
		header: {
		right: 'prev today next ',
		center: 'title',
		left: 'month,agendaWeek,agendaDay,listWeek'
		},
		height: 600,
		navLinks: true,
		editable: false,
		eventLimit: true,
		selectable : true,

		events: [

			@foreach($hearings as $hearing)
				{
					id: '{{$hearing->case_tran_id}}',
					title:'{{$hearing->case->case_title}}',
					description: 'Hearing Date: {{date('d-m-Y', strtotime( $hearing->hearing_date))}} <br> Client Name: {{$hearing->client->cust_name}}<br> Start Time: {{$hearing->start_time}} <br> Lawyer Name: <?php $law_data = json_decode($hearing->lawyer_names) ; 	
						foreach ($law_data as $value) {
						 	$user = \App\User::find($value);
						 	echo $user->name .', ';
						} 
					?> <br> Judges Name: <?php 
						$law_data = json_decode($hearing->judges_name) ;
						foreach ($law_data as $value) {
						 	echo $value .', ';
						} 
					?>',
					color:'{{date('G',strtotime($hearing->start_time)) > '12' ? '#0cab0a' : '#8259ff' }}',
					url: '{{route('case_mast.show',$hearing->case_id.',case_diary')}}',
					start: '{{$hearing->hearing_date}}',
					end: '{{$hearing->hearing_date}}',
			
				},
			@endforeach
			@foreach($todos as $todo)
			{	
				id: '{{$todo->id}}',
				title: '{{$todo->title}}',
				description: '{{$todo->description}}',
				color: '{{$todo->user_id == $todo->team_id ? '#fda503': '#ff4566'}}',
				url : '{{route('todos.show',$todo->id)}}',
				start: '{{$todo->start_date}}',
				end: '{{$todo->end_date}}',
				
			},
			@endforeach
		],
		// eventRender: function(event, element) { 
  //           element.find('.fc-title').append("" + event.description); 
  //       }, 
		eventMouseover: function(calEvent, jsEvent) {
		    var tooltip = '<div class="tooltipevent text-center" style="width:200px;min-height:100px;background:orange;position:absolute;z-index:10001; padding:5px;">' + calEvent.description + '</div>';
		    $("body").append(tooltip);
		    $(this).mouseover(function(e) {
		        $(this).css('z-index', 10000);
		        $('.tooltipevent').fadeIn('500');
		        $('.tooltipevent').fadeTo('10', 1.9);
		    }).mousemove(function(e) {
		        $('.tooltipevent').css('top', e.pageY + 10);
		        $('.tooltipevent').css('left', e.pageX + 20);
		    });
		},

		eventMouseout: function(calEvent, jsEvent) {
		     $(this).css('z-index', 8);
		     $('.tooltipevent').remove();
		},
  

		select: function(start, end, jsEvent, view) {
         	
			var start_date = moment(start).format('YYYY-MM-DD');

			var end_date =  moment(end).subtract(1, 'days').format('YYYY-MM-DD');
			// alert(end_date);
	        $('.start_date').val(start_date);
			$('.end_date').val(end_date);
			$('.h_date').val(start_date);
			$('#calendar_modal').modal({"backdrop": "static"});
	         
	    }

	
		});

	
	});
  </script>
@endsection