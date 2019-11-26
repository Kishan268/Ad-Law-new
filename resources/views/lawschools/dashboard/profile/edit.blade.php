@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="box box-primary">
			<div class="box-header ">	
				<h3 class="" style="margin-top: 10px;">Edit Profile 
					<a href="{{route('lawschools.show',$data->id)}}" class="btn btn-sm btn-info pull-right">Back</a>
				</h3>
			</div>
			<div class="box-body">
				<form  action="{{route('lawschools.update', $data->id)}}" method="post"  role="form" enctype="multipart/form-data" >
				@method('PATCH')
				<div class="row form-group ">
					<div class="col-md-12" style="margin-top:10px;">											
						<label for="username">User Name  <span class="text-danger">*</span></label> 
						<input type="text" name="name" class="form-control"  placeholder="{{__('name') }}" value="{{ old('name') ?? $data->name}}" required autocomplete="name" autofocus >

						@error('name')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;">
						<label for="email">{{ __('Email Address / username') }}</label>
						<input id="email" type="email" class="form-control  " value="{{ $data->email }}" disabled>

						@error('email')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top:10px;">
						<label for="email1">{{ __('Alternate Email Address') }}</label>
						<input id="email1" type="email" class="form-control  @error('email') is-invalid @enderror" name="email1" value="{{ old('email1') ?? $data->email1 }}" placeholder="Enter Alternate Email Address">

						@error('email1')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;">
						<label for="dob">{{Auth::user()->user_catg_id == '4' ? 'Date of registration:' : 'Date of Birth:'}} <span class="text-danger">*</span></label>
						<input type="text" value="{{old('dob') ?? $data->dob }}" class="form-control " name="dob" required autocomplete="dob" autofocus id="datepicker" data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d')}}">

						@error('dob')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror

					</div>
					@role(['teacher','student'])
					<div class="col-md-6" style="margin-top:10px;">
							<label for="gender">Gender <span class="text-danger">*</span></label>
							<select name="gender" class="form-control" > 
								<option value="0">Select Gender</option>
								<option value="m" {{ $data->gender == 'm' ? 'selected' : ''}} {{ old('gender') == 'm' ? 'selected' : ''}} >Male</option>
								<option value="f" {{ $data->gender == 'f' ? 'selected' : ''}} {{ old('gender') == 'f' ? 'selected' : ''}} >Female</option>
								<option value="t" {{ $data->gender == 't' ? 'selected' : ''}} {{ old('gender') == 't' ? 'selected' : ''}} >Other</option>
							</select>
						
							@error('gender')
			                    <span class="invalid-feedback text-danger" role="alert">
			                        <strong>{{ $message }}</strong>
			                    </span>
			                @enderror
						</div>
					@endrole
				</div>
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;">
						<label for="mobile">Mobile Number <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-addon">
				               <i class="fa fa-phone"></i>
		             		</div>
							<input type="text" name="mobile" class="form-control " placeholder="Mobile Number" value="{{ old('mobile') ?? $data->mobile }}" required autocomplete="mobile" autofocus> 							          			
						</div>
						@error('mobile')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror   
					</div>
					<div class="col-md-6" style="margin-top:10px;">
						<label for="mobile_no1">Alternate Number</label>
						<div class="input-group">
							<div class="input-group-addon">
				               <i class="fa fa-phone"></i>
		             		</div>
							<input type="text" name="mobile_no1" class="form-control" placeholder="Enter Alternate Number" value="{{old('mobile_no1') ?? $data->mobile_no1 }}"> 
						</div>
						@error('mobile_no1')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror	
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4" style="margin-top:10px;">
						<label for="state">State <span class="text-danger">*</span></label>
						<select name="state_code" class="form-control" id="state">
							<option value="0">Select state</option>
							@foreach($states as $state)
								<option value="{{ $state->state_code }}" {{$state->state_code == Auth::user()->state_code ? 'selected' : ''}} {{old('state_code') == $state->state_code ? 'selected' : ''}}>{{ $state->state_name}}</option>
							@endforeach
						</select>
						@error('state_code')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror 
					</div>
					<div class="col-md-4" style="margin-top:10px;">
						<label for="city">City <span class="text-danger">*</span></label>
							<select name="city_code" class="form-control " id="city"></select>
						@error('city_code')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-4">
						<label for="zip_code">Zip Code <span class="text-danger">*</span></label>
						<input type="text" name="zip_code" class="form-control " value="{{ old('zip_code') ?? $data->zip_code}}" placeholder="Enter Zip code" >
						@error('zip_code')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					</div>
				</div>

				<div class="row form-group">
					@role(['teacher','student'])
					<div class="col-md-4" style="margin-top:10px;">
						<label for="aadhar_card">Aadhar Number <span class="text-danger">*</span></label>
						<input type="text"  class="form-control " name="aadhar_card" value="{{ old('aadhar_card') ?? $data->aadhar_card}}" placeholder="Enter Aadhar Number">
						@error('aadhar_card')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
					<div class="col-md-4" style="margin-top:10px;">
						<label for="pan_card">PAN Number</label>
						<input type="text"  class="form-control " name="pan_card" value="{{ old('pan_card') ?? strtoupper($data->pan_card)}}" placeholder="Enter PAN number">
						@error('pan_card')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
					@endrole
					@role(['teacher','lawcollege'])					
					<div class="col-md-4" style="margin-top:10px;">
						<label for="estd_year">
							@role('lawcollege')	
								Established Year
							@endrole
							@role('teacher')	
								Experience
							@endrole
						</label>
						<input type="text" name="estd_year" class="form-control " 
							@role('lawcollege')	
								placeholder="Enter Established Year"
							@endrole
							@role('teacher')	
								placeholder="Enter Experience"
							@endrole
							 value="{{ old('estd_year')?? $data->estd_year }}" >
							@error('estd_year')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
	        	        @enderror
					</div>
					@endrole
				</div>
				@role('lawcollege')	
				<div class="row form-group">
					<div class="col-md-4" style="margin-top:10px;">
						<label for="licence_no">Registration Number <span class="text-danger">*</span></label>
						<input type="text" name="licence_no" class="form-control " value="{{ old('licence_no') ?? $data->licence_no}}" placeholder="Enter Bar licence number" >
						@error('licence_no')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
						<div class="col-md-4" style="margin-top:10px;">
						<label for>Number of Student</label>
						<input type="text" name="tot_user_count" class="form-control " value="{{old('tot_user_count')?? $data->tot_user_count}}" placeholder="Enter number of student">
						@error('tot_user_count')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-4" style="margin-top:10px;">
						<label for>Number of Teachers</label>
						<input type="text" name="tot_branch_count" class="form-control " value="{{ old('tot_branch_count') ?? $data->tot_branch_count }}" placeholder="Enter number of teacher">
						@error('tot_branch_count')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
            @endrole
				<div class="row form-group">
					<div class="col-sm-12" style="margin-top:10px;">
						<label for="detl_profile">Detail Profile</label>
						<textarea name="detl_profile" rows="10" cols="50" class="form-control tinymce" placeholder="About You.."  id="summernote">{{old('detl_profile') ?? $data->detl_profile}} </textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;">
						<div class="row">
							<div class="col-md-12">
								<label for="photo" >Profile Photo</label>
								<input type="file" name="photo" id="photo">
								@error('photo')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12">
								@if(Auth::user()->photo !='')
									<img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}"  style="width: 100px; height: 100px;" class="form-control" />
								@else
									<img src="{{asset('storage/profile_photo/default.png')}}"  style="width: 100px; height: 100px;" class="form-control" />

								@endif
							</div>
						</div>						
					</div>
					@role('lawcollege')
					<div class="col-md-6" style="margin-top:10px;">
						<div class="row">
							<div class="col-md-12">
								<label for="prospectus" >Prospectus</label>
								<input type="file" name="pdf" id="pdf" class="" style="margin-bottom: 14px;">
							</div>
							<div class="col-md-12">
								@if($data->doc_url)
									<span><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
										{{$data->doc_url}}
									</span>
								@endif
								@error('pdf')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>						
					</div>
						@endrole
				</div>
			
				<div class="row form-group">
					<div class="col-md-12" style="margin-top:10px;">						
						<input type="submit" name="submit" class="btn btn-md btn-info" value="Submit" id="submitdata">
					</div>
				</div>
				@csrf
				</form>
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript">

	$(document).ready(function(){
		$(function () {
			$("#datepicker").datepicker({ 
				singleDatePicker: true,
				showDropdowns: true,
			});
		});

		$('#individual').on('change', function(){
			$('#comp_select').hide();
		});
		$('#unlawcomp').on('change', function(){

			$('#comp_select').show();	
		});

		var user_flag = $("input[name='user_flag']:checked").val();
		if(user_flag=='ct'){
			$('#comp_select').show();
		}

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
                    $("#city").append('<option value="'+value.city_code+'">'+value.city_name+'</option>');
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



var oldCity_code = "{{old('city_code')}}";
var stateCode = $('#state').val();
	
	if(stateCode!=0){
	$.ajax({
			
		type:"GET",
		 url:"{{route('cityDropDown')}}?state_code="+stateCode,
		success:function(res){    

			if(res){     
				$("#city").empty();
				$("#city").append('<option value="0">Select City</option>');
				
				$.each(res.cities,function(index, cityObj){

				$("#city").append('<option value="' + cityObj.city_code + '" ' + (cityObj.city_code === res.cityCode ? 'selected="selected"' : '' )+ ' ' + (cityObj.city_code == oldCity_code ? 'selected="selected"' : '' )+ '>'+cityObj.city_name+'</option>');
				});	
				}
				else{
					$("#city").empty();
				}
		}
	});
	}

tinymce.init({
 /* replace textarea having class .tinymce with tinymce editor */
		selector: "textarea.tinymce",
		// theme: "modern",
		// skin: "lightgray",
		plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
		
		"   directionality emoticons template paste textcolor"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor ",

		height: 300,
  });
 





});
</script>


@endsection
