@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header " >
				<h3 style="margin-top: 10px;">Edit Client Profile <a href="{{route('clients.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3> 
			</div>
			<div class="box-body">
				<form action="{{route('clients.update', ['id' => $client->cust_id ])}}" method="post">
				@method('PATCH')
				@csrf
					<div class="row">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="name">Name <span class="text-danger">*</span></label>
							<input type="text" name="cust_name" class="form-control" placeholder="Enter Client Name" value="{{ old('cust_name') ?? $client->cust_name}}" required>
							@error('cust_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<label for="status">Client Type <span class="text-danger">*</span></label>
							<select name="cust_type_id" class="form-control" id="cust_type">
								<option value="0">Select Client Type</option>
								@foreach($cust_types as $cust_type)
									<option value="{{$cust_type->cust_type_id}}" {{$client->cust_type_id == $cust_type->cust_type_id ? 'selected': ''}} >{{$cust_type->cust_type_name}} </option>
								@endforeach		
							</select>
							@error('cust_type_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror	
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="status">Status <span class="text-danger">*</span></label>
							<select name="status_id" class="form-control">
								<option value="0">Select Status</option>
								@foreach($status_types as $status)
									<option value="{{$status->status_id}}" {{$client->status_id == $status->status_id ? 'selected' : '' }}>{{$status->status_desc}}</option>
								@endforeach
							</select>
							@error('status_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<label for="regsdate">Client Registration Date <span class="text-danger">*</span></label>
							<input type="text" value="{{old('regsdate') ?? $client->regsdate}}" class="form-control " name="regsdate" required autocomplete="regsdate" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" >
							@error('regsdate')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group" style="display: none" id="bothGD">
						<div class="col-md-6" style="margin-top:10px; " id="gender">
						<label for="gender">Gender <span class="text-danger">*</span></label>
						<select name="gender" class="form-control">
						<option value="0">Select Gender </option>	
						<option value="m" {{ (old('gender')== 'm') ? 'selected' : ''}} {{$client->gender == 'm' ? 'selected' : ''}}>Male</option>
						<option value="f" {{ (old('gender')== 'f' ) ? 'selected' : '' }} {{$client->gender == 'f' ? 'selected' : ''}}>Female</option>
						<option value="t" {{ (old('gender')== 't') ? 'selected' : ''}} {{$client->gender == 't' ? 'selected' : ''}}>Other</option>
						</select>
						@error('gender')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-md-6" style="margin-top:10px;" id="dob">
						<label for="dob">Date of Birth</label>
						<input type="text" value="{{old('dob') ?? $client->dob}}" class="form-control " name="dob" id="datepicker" data-date-format="yyyy-mm-dd" placeholder="<?php echo date('Y-m-d'); ?>" >
						@error('dob')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					</div>		
					<div class="row form-group">						
						<div class="col-md-6" style="margin-top:10px;">
							<label for="mobile1">Mobile Number <span class="text-danger">*</span></label>
							<input type="text" value="{{old('mobile1') ?? $client->mobile1 }}" class="form-control " name="mobile1" placeholder="Mobile Number">
							@error('mobile1')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<label for="mobile2">Alternate Mobile Number</label>
							<input type="text" value="{{old('mobile2') ?? $client->mobile2 }}" class="form-control " name="mobile2" placeholder="Alternate Mobile Number">
							@error('mobile2')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="tele">Telephone Number</label>
							<input type="tele" value="{{old('tele')?? $client->tele }}" class="form-control " name="tele" placeholder="Telephone Number">
							@error('tele')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror								
						</div>	
						<div class="col-md-6" style="margin-top:10px; display: none;" id="company_name">
							<label for="company_name">Company Name <span class="text-danger">*</span></label>
							<input type="text" value="{{old('company_name') ?? $client->company_name}}" class="form-control " name="company_name"  placeholder="Enter Company Name" >
							@error('company_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>								
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="email">Email Address</label>
							<input type="email" value="{{old('email') ?? $client->email}}" class="form-control " name="email" placeholder="Enter Email Address" >
							@error('email')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
							
						<div class="col-md-6" style="margin-top:10px;">
							<label for="gender">State Name <span class="text-danger">*</span></label>
							<select name="state_code" class="form-control" id="state">
								<option value="0">Select State </option>
								@foreach($states as $state)
									<option value="{{$state->state_code}}" {{$client->state_code == $state->state_code ? 'selected' : ''}} >{{$state->state_name}}</option>
								@endforeach
							</select>
							@error('state_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="city">City Name <span class="text-danger">*</span></label>
							<select name="city_code" class="form-control" id="city">
								
							</select>
							@error('city_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>							
						<div class="col-md-6" style="margin-top:10px;">
							<label for="aadhar">Aadhar Number</label>
							<input type="text" value="{{old('adharno') ?? $client->adharno }}" class="form-control " name="adharno" placeholder="Aadhar Number">
							@error('adharno')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="panno">PAN Number</label>
							<input type="text" value="{{old('panno') ?? $client->panno }}" class="form-control " name="panno" placeholder="PAN Number">
							@error('panno')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					
						<div class="col-md-6" style="margin-top:10px;">
							<label for="gstno">GST Number</label>
							<input type="text" value="{{old('gstno') ?? $client->gstno }}" class="form-control " name="gstno" placeholder="GST Number">
							@error('gstno')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
						</div>
					</div>
					<div class="row form-group">						
						<div class="col-md-12">
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							<input type="hidden" name="country_code" value="102" >
							<button type="submit" class="btn btn-primary btn-md">Update</button>
						</div>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){
		$(function () {
			$("#datepicker, #regdatepicker").datepicker({ 
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
	   
	var state_code =("{{old('state_code')}}" == '' ? "{{$client->state_code}}" : "{{old('state_code')}}" );  
	var city_code = ("{{old('city_code')}}" == '' ? "{{$client->city_code}}" : "{{old('city_code')}}" );

	if(state_code !=''){
		state(state_code, city_code);
	}


	$('#cust_type').on('change',function(){
		var cust_type = $('#cust_type').val();
		if(cust_type==1){
			$('#bothGD').show();
	
			$('#company_name').hide();
			
		}
		else{
			$('#company_name').show();
			$('#bothGD').hide();
	
		}
	});


	var cust_type = $('#cust_type').val();
		if(cust_type==1){
			$('#bothGD').show();
			$('#company_name').hide();
			
		}
		else{
			$('#company_name').show();
			$('#bothGD').hide();
		}
});
</script>
@endsection