@extends('layouts.default')
@section('content')
<style type="text/css">
@media only screen and (max-width: 600px) {
  /* For mobile phones: */
  .col-xm-12{
  	margin-top: 10px;
  }

}
@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .col-xm-12{
  	margin-top: 10px;
  }

}
@media only screen and (min-width: 992px) {
	.book{
		padding-right: 1px;

	}
	.viewP{
		padding-left: 0px;
	}
} 


</style>

<!-- <div class="container-fluid" style="background-color: white"> -->
<div class="container mt-2" style="">
	<div class="row">
		<div class="col-md-12 col-xm-12 col-sm-12 col-sm-12">
			{{-- <a href="{{route('search.search_index')}}">search</a> --}}
			<div class="row">
				<div class="col-sm-12 col-md-12 col-xl-12">
				   <h3 class="text-center"><b>Book an Appointment Now with Lawyer Here !</b></h3>
				</div>

			</div>
			<div class="row" id="search_field">
				<div class="col-md-8 col-sm-8 col-xs-8 d-inline-flex radio-group m-auto" style=" padding:0;background-color: #b4ddf3;"> 
		          <div class="col-md-4  text-center btn big {{ $searchfield=='lawyer' ? 'active_class' : '' }} " id="lawyer">

                    Lawyer

                  <input id="chb1" type="radio" name="searchfield1" style="visibility: hidden" value="lawyer" {{ $searchfield=='lawyer' ? 'checked' : ''}}   />

                  </div>

                  <div class="col-md-4 text-center btn big {{ $searchfield == 'lawcompany' ? 'active_class' : ''}} " id="lawcompany">

                    Law Company
                  <input id="chb2" type="radio" name="searchfield1" style="visibility: hidden" value="lawcompany" {{ $searchfield == 'lawcompany' ? 'checked' : ''}} />

                  </div>

                  <div class="col-md-4 text-center btn big {{ $searchfield=='lawcollege' ? 'active_class' : ''}} "  id="lawcollege">

                    Law College
                    <input id="chb3" type="radio" name="searchfield1" style="visibility: hidden"  value="lawcollege" {{ $searchfield=='lawcollege' ? 'checked' : ''}} />

                  </div>
		         </div>

			</div>
		@if($message = Session::get('success'))
			<div class="alert alert-success mt-2">
				{{$message}}
			</div>
		@endif
			@if($message = Session::get('warning'))
			<div class="alert alert-warning mt-2">
				{{$message}}
			</div>
		@endif
			
			<div class="row mb-1" >
				<div class="col-md-6 col-xm-12 col-sm-12">
					<p class="mb-1" style="font-size: 18px; font-weight: 550">Filter</p>
					<div class="row ">
				{{-- 		<div class="col-md-1 col-sm-12 col-xm-12">
							<a href="#" class="btn btn-md btn-light border">All</a>
						</div> --}}
						<div class="col-md-4 col-xm-12 col-sm-12	">

							<select class="form-control" id='specialist_lawyer' >
								<option value="0">Select Specialization</option>

								@foreach($specialities as $speciality)
									<option value="{{ $speciality->catg_code }}" {{ $speciality->catg_code == $speciality_code ? 'selected' : ''}}>{{$speciality->catg_desc}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4 col-xm-12 col-sm-12">
							<select class="form-control" id="state" name="state_code">
								<option value="0">Choose a state</option>
								@foreach($states as $state)
									<option value="{{ $state->state_code }}"  {{ $state->state_code == $state_code ? 'selected' : '' }}>{{$state->state_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4 col-xm-12 col-sm-12">
							<select class="form-control" id="city" name="city_code">
								@if($city_name)
									<option value="{{$city_code}}">{{$city_name}}</option>
								@endif
							</select>
						</div>
					</div>
				</div>
			
				<div class="col-md-6 col-xm-12 col-sm-12 text-right "  >
					<p class="mb-1" style="font-size: 18px; font-weight: 550">Lawyer Gender</p>
					<label class="radio-inline mr-3"><input type="radio" name="gender" value="all" checked>Any</label>
					<label class="radio-inline mr-3"><input type="radio" name="gender" value="m" >Male</label>
					<label class="radio-inline mr-3"><input type="radio" name="gender" value="f">Female</label>
					<label class="radio-inline "><input type="radio" name="gender" value="t">Other</label>
				</div>
			 </div>	
	
		
		</div>
	</div>

	<div class="row mt-2"  id="withoutsearchDiv">
		<div class="col-md-12 col-sm-12 col-xm-12" id="tablediv">

			@include('search.search_table')

		</div>
	
	
	</div>
	<div class="modal modal-fade " id="bookingModal">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
						<h4 class="modal-title">Book an Appointment</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
						
					</div>
				<div class="modal-body">
					<form action="{{route('book_an_appointment')}}" method="post">
						@csrf
					<div class="row form-group">
						<div class="col-md-12">
							<label>Booking Date</label>
							<input type="text"  value="" name="b_date" readonly="" class="form-control">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label>Booking Time</label>
							<input type="text" name="slot_time" value="" class="form-control" readonly="" id="">
							<input type="hidden" name="plan_id" value="" >

						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							{{-- <label>Contact Type</label> --}}
							{{-- <input type="hidden" name="" value="" class="form-control"  id=""> --}}

						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
						
							<input type="hidden" name="user_id" value="">
							<input type="hidden" name="client_id" value="">
							<button type="submit" class="btn btn-sm btn-info">Submit</button>
						</div>
					</div>
					</form>
				</div>
				<div class="modal-footer">
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>						 	
	</div>
</div>
<script >
function loginChecked($user_id){
	var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
	if(AuthUser){
		let url = "{{ route('message.create', 'id=:id') }}";
	    url = url.replace(':id', $user_id);
	    document.location.href=url;
	}
	else{
		swal({
			title: 'Please login',
			text : "If you want to contact with lawyer so login first",
			type : 'warning',
			showCancelButton:true,
			showConfirmButton:true,
			confirmButtonText: "<a href='{{route('login')}}'>Login</a>", 
		});
	}
}	

</script>
<script type="text/javascript">
	  $(document).ready(function(){

  	   $('.radio-inline').click(function() {
         
           $(this).find('input').prop('checked', true) ;   
      });


	$('#state').on('change',function(){

		var state_code = $(this).val();
		var specialist =  $('#specialist_lawyer').val();

		if(state_code!=0){
		$.ajax({
		    type:"GET",
		    url:"{{ route('city') }}?state_code="+state_code,
		    success:function(res){ 
		    // alert(res);              
		        if(res){
		        	//alert(res);
		        $("#city").empty();
		        $("#city").append('<option value="0">Select City</option>');
		        $.each(res,function(index, cityObj){
		        $("#city").append('<option value="'+cityObj.city_code+'">'+cityObj.city_name+'</option>');
		});

		        }
		        else{
		        $("#city").empty();
		        }
		    }
		});
		}
		else{

		$("#city").empty();
		}
    });
   $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	});
	


	$("#specialist_lawyer, #state, #city, input[type=radio][name=gender],#lawyer,#lawcollege,#lawcompany").on('change click',function(e){
		
		e.preventDefault();

		var specialist =  $('#specialist_lawyer').val();
		var state_code = $('#state').val();
		var city_code = $('#city').val();
		var gender = $("input[name='gender']:checked").val();
		var searchfield = $("input[name='searchfield1']:checked").val();
	// alert(searchfield);
		$.ajax({

			    type:"post",
			    url:"{{ route('find_lawyer.specialist') }}?speciality="+specialist+'&state_code='+state_code+'&city_code='+city_code+'&gender='+gender+'&searchfield='+searchfield,
				   // success:function(data){ 
				   // 		$("#tablediv").empty().html(data);
				   // }
		        }).done(function(data){
		            $("#tablediv").empty().html(data);
		          
		        }).fail(function(jqXHR, ajaxOptions, thrownError){
		            alert('No response from server');
		           	
			
			});


	});

 });
</script>
@endsection