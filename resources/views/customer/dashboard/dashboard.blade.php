@extends('customer.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@if($message = Session::get('success'))
				<div style="margin-top: 10px;" class="alert bg-success">
					{{$message}}
				</div>
			@endif
			<div class="modal modal-fade" id="profile-modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Complete Your Profile</h4>
						</div>
						<div class="modal-body">
							<form action="{{route('customer.update', ['id'=>Auth::user()->id])}}" method="post">
								@method('PATCH')
							<div class="row form-group">
								<div class="col-md-12">
									<label >Mobile Number <span class="text-danger">*</span></label>
									<input type="text" name="mobile" value="{{old('mobile')}}" placeholder="Enter mobile number" class="form-control" required />
								@error('mobile')
									<span class="invalid-feedback d-block" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label >Date of Birth <span class="text-danger">*</span></label>
									<input type="text" name="dob" value="{{old('dob')}}" placeholder="{{date('Y-m-d')}}" class="form-control" id="dob"  required autocomplete="dob" autofocus  data-date-format="yyyy-mm-dd" />
									@error('dob')
										<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
										</span>
								@enderror
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label>Gender <span class="text-danger">*</span></label>
									<select class="form-control" name="gender" required>
										<option value="0" disabled selected>Select Gender</option>
										<option value="m" >Male</option>
										<option value="f" >Female</option>
										<option value="t" >Other</option>
									</select>
									@error('gender')
										<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label>State <span class="text-danger">*</span></label>
									<select class="form-control" name="state_code" id="state"required>
										<option value="0" disabled selected> Select State</option>
										@foreach($states as $state)
											<option value="{{$state->state_code}}">{{$state->state_name}}</option>
										@endforeach
									</select>
									@error('state_code')
										<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label>City <span class="text-danger">*</span></label>
									<select class="form-control" name="city_code" id="city" required>
										
									</select>
									@error('city_code')
										<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						
							<button type="submit" class="btn btn-sm btn-info">Submit</button>
						</div>
						@csrf
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
<script>
	$(document).ready(function(){
		var mobile ="{{Auth::user()->mobile}}";
		if(mobile == ''){
			$('#profile-modal').modal({"backdrop": "static"});
		}

		$(function () {
			$("#dob").datepicker({ 
				singleDatePicker: true,
				showDropdowns: true,
			});
		});

$('#state').on('change',function(){
    var state_code = $(this).val();    
    if(state_code){
        $.ajax({
           type:"GET",
           url:"{{route('city')}}?state_code="+state_code,
           success:function(res){               
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+value.city_code+'" >'+value.city_name+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });

	});
</script>
@endsection