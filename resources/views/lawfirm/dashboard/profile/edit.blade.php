@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto ">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="" style="margin-top: 10px;">Edit Profile 
					<a href="{{route('lawfirm.show',$user->id)}}" class="btn btn-sm btn-info pull-right">Back</a>
				</h3>
			</div>
		
			<div class="box-body">
				<form action="{{ route('lawfirm.update', $user->id)}}" method="post"  role="form" enctype="multipart/form-data" >
				@method('PATCH')
				<div class="row form-group">
					<div class="col-md-12" style="margin-top:10px;"> 
						<label for="username">User Name  <span class="text-danger">*</span></label> 
						<input type="text" name="name" class="form-control"  placeholder="{{__('name') }}" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus >

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
			                <input id="email" type="email" class="form-control  " value="{{ $user->email }}" disabled>

			                @error('email')
			                    <span class="invalid-feedback text-danger" role="alert">
			                        <strong>{{ $message }}</strong>
			                    </span>
			                @enderror
		          	</div>
		          	<div class="col-md-6" style="margin-top:10px;">
			            	<label for="email1">{{ __('Alternate Email Address') }}</label>
			                <input id="email1" type="email" class="form-control  @error('email') is-invalid @enderror" name="email1" value="{{ old('email1') ?? $user->email1 }}" placeholder="Enter Alternate Email Address">

			                @error('email1')
			                    <span class="invalid-feedback text-danger" role="alert">
			                        <strong>{{ $message }}</strong>
			                    </span>
			                @enderror
		          	</div>
		        </div>
				
				<div class="row form-group">
					@role('lawyer')	
					<div class="col-md-6" style="margin-top:10px;">
						<label for="gender">Gender <span class="text-danger">*</span></label>
						<select name="gender" class="form-control"> 
							<option value="0">Select Gender</option>
							<option value="m" {{ $user->gender == 'm' ? 'selected' : ''}} {{old('gender')== 'm' ? 'selected' : ''}}>Male</option>
							<option value="f" {{ $user->gender == 'f' ? 'selected' : ''}} {{old('gender')== 'f' ? 'selected' : ''}}>Female</option>
							<option value="t" {{ $user->gender == 't' ? 'selected' : ''}} {{old('gender')== 't' ? 'selected' : ''}}>Other</option>
						</select>

						@error('gender')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                 @enderror
					</div>
					@endrole
					<div class="col-md-6" style="margin-top:10px;">
						<label for="dob">
							@role('lawyer') DOB @endrole 
							@role('lawcompany') Registration Date @endrole
							<span class="text-danger">*</span></label>
						<input type="text" value="{{old('dob') ?? $user->dob }}" class="form-control " name="dob" required autocomplete="dob" autofocus  id="datepicker" data-date-format="yyyy-mm-dd">

						@error('dob')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

					</div>
				</div>
				
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;">
						<label for="mobile">Mobile Number <span class="text-danger">*</span>  </label>
						<div class="input-group">
							<div class="input-group-addon">
				               <i class="fa fa-phone"></i>
		             		</div>
		             	<input type="text" name="mobile" class="form-control " placeholder="Mobile Number" value="{{ old('mobile') ?? $user->mobile }} " required autocomplete="mobile" autofocus> 
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
		             		<input type="text" name="mobile_no1" class="form-control" placeholder="Enter Alternate Number" value="{{ old('mobile_no1')  ?? $user->mobile_no1 }}"> 
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
						<label for="state_code">State <span class="text-danger">*</span> </label>

						<select name="state_code" class="form-control" id="state">
							<option value="0">Select state</option>
							@foreach($states as $state)
								<option value="{{ $state->state_code }}" {{$state->state_code == $user->state_code ? 'selected' : ''}} {{ old('state_code')== $state->state_code ? 'selected' : ''}}>{{ $state->state_name}}</option>
							@endforeach
						</select>
						@error('state_code')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror 
					</div>
					<div class="col-md-4" style="margin-top:10px;">
						<label for="city_code">City <span class="text-danger">*</span> </label>
						<select name="city_code" class="form-control " id="city">
						</select>
						@error('city_code')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
					<div class="col-md-4" style="margin-top:10px;">
						<label for="zip_code">Zip Code <span class="text-danger">*</span></label>
						<input type="text" name="zip_code" class="form-control " value=" {{ old('zip_code') ?? $user->zip_code}}" placeholder="Enter Zip code" >
						@error('zip_code')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

					</div>
				</div>
				<div class="row form-group" >
					<div class="col-md-6" style="margin-top:10px;">
						<label for="licence_no">
							@role('lawyer') Bar Licence Number @endrole 
							@role('lawcompany') Registration Number @endrole
							
							 <span class="text-danger">*</span></label>
						<input type="text" name="licence_no" class="form-control " value=" {{ old('licence_no') ?? $user->licence_no}}" >
						@error('licence_no')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

					</div>
					@role('lawyer')
					<div class="col-md-6" style="margin-top:10px;">
						<label for="aadhar_card">Aadhar Number <span class="text-danger">*</span></label>
						<input type="text"  class="form-control " name="aadhar_card" value="{{ old('aadhar_card') ?? $user->aadhar_card}}" placeholder="Enter Aadhar Number">
						@error('aadhar_card')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
					@endrole
				</div>
				<div class="row form-group">
					@role('lawyer')
					<div class="col-md-6" style="margin-top:10px;">
						<label for="pan_card">PAN Number</label>
						<input type="text"  class="form-control text-uppercase" name="pan_card" value="{{ old('pan_card') ?? $user->pan_card}}" placeholder="Enter PAN Number">
						@error('pan_card')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
					@endrole
					<div class="col-md-6" style="margin-top:10px;">
						<label for="experience">
						@role('lawyer')Experience @endrole
						@role('lawcompany')Established Year @endrole
					</label>
						<input type="text" name="estd_year" class="form-control"  value="{{ old('estd_year')?? $user->estd_year }}" >
							@error('estd_year')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>			
				</div>
				<div class="row form-group">
					<div class="col-md-4" style="margin-top:10px;">
						<label for="tot_user_count">
						@role('lawyer')Number of Users @endrole
						@role('lawcompany')Number of lawyers @endrole
						</label>
						<input type="text" name="tot_user_count" class="form-control" value="{{old('tot_user_count') ?? $user->tot_user_count}}">
						@error('tot_user_count')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
					<div class="col-md-4" style="margin-top:10px;">
						<label for="tot_branch_count">Number of Branch</label>
						<input type="text" name="tot_branch_count" class="form-control " value="{{old('tot_branch_count') ?? $user->tot_branch_count}}">
						@error('tot_branch_count')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
					<div class="col-md-4" style="margin-top:10px;">
						<label for="tot_court_count">Courts Engaged</label>
						<input type="text" name="tot_court_count" class="form-control " value="{{old('tot_court_count') ?? $user->tot_court_count}}">
						@error('tot_court_count')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12" style="margin-top:10px;">
						<label for="detl_profile">Detail Profile</label>
						<textarea name="detl_profile" rows="10" cols="50" class="form-control tinymce" placeholder="About You.." >{{ old('detl_profile') ?? $user->detl_profile }}</textarea>
					</div>					
				</div>		
				<div class="row form-group">
					<div class="col-md-12" style="margin-top:10px;">
						<label for="photo" >Profile Photo</label>
						<input type="file" name="photo" id="photo" >
						@error('photo')
		                    <span class="invalid-feedback text-danger" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		            </div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top:10px;"> 
						@if(Auth::user()->photo !='')
					        <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}"  style="width: 100px; height: 100px;" class="form-control" />
					    @else
					        <img src="{{asset('storage/profile_photo/default.png')}}"  style="width: 100px; height: 100px;" class="form-control" />

					    @endif
				    	
					</div>
				</div>
			
{{-- 	<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					
				</div>
				<div class="modal-body">
					<div id="upload-demo" class=""></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
				</div>
			</div>
		</div>
	</div> --}}
		
				<div class="row">
					<div class="col-md-12"  style="margin-top:10px;">
						<input type="hidden" name="country_code" value="102">
						<input type="submit" name="submit" class="btn btn-md btn-info" value="Update" id="submitdata">
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

	$('#state').on('change',function(e){
		e.preventDefault();
		var state_code = $(this).val();
		var city_code = "";
		state(state_code, city_code);
	});
	   
	var state_code =("{{old('state_code')}}" == '' ? "{{$user->state_code}}" : "{{old('state_code')}}" );  
	var city_code = ("{{old('city_code')}}" == '' ? "{{$user->city_code}}" : "{{old('city_code')}}" );

	if(state_code !=''){
		state(state_code, city_code);
	}


	tinymce.init({
		selector: "textarea.tinymce",
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