@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Add New Client
				<a href="{{route('clients.index')}}" class="btn btn-sm btn-info pull-right">Back</a>
				</h3> 
			</div>
			<div class="box-body">
				<form action="{{route('clients.store')}}" method="post">
				@csrf
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;">
						<label for="name">Name <span class="text-danger">*</span></label>
						<input type="text" name="cust_name" class="form-control" placeholder="Enter Client Name" value="{{ old('cust_name')}}" required>
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
							<option value="{{$cust_type->cust_type_id}} " {{ old('cust_type_id') == $cust_type->cust_type_id ? 'selected' : ''}}>{{$cust_type->cust_type_name}}</option>
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
							
								<option value="{{ $status->status_id }}" {{old('status_id')==$status->status_id  ? 'selected' : ''}}>{{ $status->status_desc }}</option>
								
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
						<input type="text" value="{{old('regsdate')}}" class="form-control " name="regsdate" required autocomplete="regsdate" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" placeholder="<?php echo date('Y-m-d'); ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px; display: none" id="gender">
						<label for="gender">Gender <span class="text-danger">*</span></label>
						<select name="gender" class="form-control">
						<option value="0">Select Gender </option>	
						<option value="m" {{ (old('gender')== 'm') ? 'selected' : ''}}>Male</option>
						<option value="f" {{ (old('gender')== 'f' ) ? 'selected' : '' }}>Female</option>
						<option value="t" {{ (old('gender')== 't') ? 'selected' : ''}}>Other</option>
						</select>
						@error('gender')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-md-6" style="margin-top:10px; display: none;" id="dob">
						<label for="dob">Date of Birth</label>
						<input type="text" value="{{old('dob')}}" class="form-control " name="dob" id="datepicker" data-date-format="yyyy-mm-dd" placeholder="<?php echo date('Y-m-d'); ?>" >
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
						<input type="text" value="{{old('mobile1')}}" class="form-control " name="mobile1" placeholder="Mobile Number">
						@error('mobile1')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top:10px;">
						<label for="mobile2">Alternate Mobile Number</label>
						<input type="text" value="{{old('mobile2')}}" class="form-control " name="mobile2" placeholder="Alternate Mobile Number">
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
						<input type="tele" value="{{old('tele')}}" class="form-control " name="tele" placeholder="Telephone Number">
						@error('tele')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top:10px; display: none;" id="company_name">
						<label for="company_name">Company Name <span class="text-danger">*</span></label>
						<input type="text" value="{{old('company_name')}}" class="form-control " name="company_name"  placeholder="Enter Company Name" >
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
						<input type="email" value="{{old('email')}}" class="form-control " name="email" placeholder="Enter Email Address" >
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
							
						<option value="{{$state->state_code}}" {{old('state_code')==$state->state_code ? 'selected' : ''}}>{{$state->state_name}}</option> 
						
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
						<input type="text" value="{{old('adharno')}}" class="form-control " name="adharno" placeholder="Aadhar Number">
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
						<input type="text" value="{{old('panno')}}" class="form-control " name="panno" placeholder="PAN Number">
						@error('panno')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				
					<div class="col-md-6" style="margin-top:10px;">
						<label for="gstno">GST Number</label>
						<input type="text" value="{{old('gstno')}}" class="form-control " name="gstno" placeholder="GST Number">

						@error('gstno')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
							<br>
							<br>

					</div>

				</div>
				{{-- <div class="row form-group">
					<div class="col-md-12">
						<div class="box ">
							<div class="box-header with-border ">
								<h4 class="box-title "><b>Point of contacts</b></h4>
							</div>
							<div class="box-body">
								<table class="table table-bordered" id="tablepoints">
									<thead>
										<tr>
											<th>Full Name</th>
											<th>Email Address</th>
											<th>Mobile Number</th>
											<th>Designation</th>
											<th>Action</th>
										</tr>										
									</thead>
									<tbody >
										
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5" class="text-right">
												<a class="btn btn-sm btn-success text-white addMore">Add More</a>	
											</td>											
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div> --}}
				<div class="row form-group">						
					<div class="col-md-12 col-xs-12 col-sm-12 mt-2">
						<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
						<input type="hidden" name="country_code" value="102" >
						<button type="submit" class="btn btn-primary btn-md">Submit</button>

					</div>

				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	// function addMore(){

	// 	$('#myTable').append('<tr><td><input type="text" name="p_name[]" class="form-control"></td><td><input type="email" name="p_email[]" class="form-control"></td><td><input type="text" name="p_mobile[]" class="form-control"></td><td><input type="text" name="p_designation[]" class="form-control"></td><td><a class="btn btn-sm btn-danger remove"><i class="fa fa-minus text-white"></i></a></td></tr>');
	// }
	// // function remove(){
	// // 	alert('hello');
	// // 	console.log($(this).closest('tr').remove()); 
	// // }
	
</script>
<script>
	$(document).ready(function(){
		
		
	 // var count = "{{old('countfield') != '' ? old('countfield') : '1' }}";
		
		
		// 	for(i = 1; i<=count ; i++){

		// 		addmore(count);
		// 	}
		// function addmore(number){

		// 		var html = '<tr>';
		// 		html += '<td><input type="text" name="p_name[]" class="form-control"></td>';
		// 		html += '<td><input type="email" name="p_email[]" class="form-control"></td>';
		// 		html += '<td><input type="text" name="p_mobile[]" class="form-control"></td>';
		// 		html += '<td><input type="text" name="p_designation[]" class="form-control"></td>'
		// 		html += '<td><a class="btn btn-sm btn-danger remove"><i class="fa fa-minus text-white"></i></a><input type="hidden" name="countfield" value='+number+' ></td></tr>';
				
		// 			$('#tablepoints tbody').append(html);
			
			
		// }
		// $('.addMore').click(function(){
		// 	count++;
		// 	addmore(count);
		// })
		// $('#tablepoints tbody').on("click",'.remove',function(){
		//     $(this).closest('tr').remove(); 
		// });



		$(function () {
			$("#datepicker, #regdatepicker").datepicker({ 
				setDate: new Date(),

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
	   
	var state_code = $('#state').val();  
	var city_code = "{{old('city_code')}}";

	if(state_code !=''){
		state(state_code, city_code);
	}

	
	$('#cust_type').on('change',function(){
		var cust_type = $('#cust_type').val();
		if(cust_type==1){
			$('#gender').show();
			$('#dob').show();
			$('#company_name').hide();
			
		}
		else{
			$('#company_name').show();
			$('#dob').hide();
			$('#gender').hide();
		}
	});


	var cust_type = $('#cust_type').val();
		if(cust_type==1){
			$('#gender').show();
			$('#dob').show();
			$('#company_name').hide();
			
		}
		else{
			$('#company_name').show();
			$('#dob').hide();
			$('#gender').hide();
		}


});
</script>
@endsection