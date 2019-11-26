@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit City <a href="{{route('city.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
							<form action="{{route('city.update', ['id' => $city->city_code ])}}" method="post">
							@method('PATCH')
							@csrf
							<div class="row form-group">
								<div class="col-md-6">
									<label for="country_code">Select Country Name <span class="text-danger">*</span></label>
									<select class="form-control" name="country_code" id="country">
										<option value="0">Select Country Name</option>
										@foreach($countries as $country)
											<option value="{{$country->country_code}}" {{$city->country_code == $country->country_code ? 'selected' : ''}} {{old('country_code') == $country->country_code ? 'selected' : '' }}>{{$country->country_name}}</option>
										@endforeach
										@error('country_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
										@enderror
									</select>
								</div>

								<div class="col-md-6">
									<label for="state_code">Select State Name <span class="text-danger">*</span></label>
									<select class="form-control" name="state_code" id="state">
										
									</select>
									@error('state_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>								
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="city_name">Enter City Name <span class="text-danger">*</span></label>
									<input type="text" name="city_name" class="form-control" id="city" value="{{$city->city_name}}">
									@error('city_name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 ">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	<script type="text/javascript">
	$(document).ready(function(){
			$("select[name='country_code'],select[name='state_code']").select2();


		$("#country").on('change',function(e){
		  	e.preventDefault();
		  	var country_id = $(this).val();
		    $.ajax({ 
		      type:"GET",
		      url:"{{route('state')}}?country_id="+country_id,
		      success:function(res)
		      {   		     
		          if(res.length !=0){
		              $("#state").empty();

		              $("#state").append('<option value="0">Select State</option>');
		              $.each(res,function(key,value){
		                  $("#state").append('<option value="'+value.state_code+'">'+value.state_name+'</option>');
		              });
		          }else{
		              $("#state").empty();		              
		          }
		      }
		    });
		});

		var oldcountry_id = "{{old('country_code')}}";

		var country_id = (oldcountry_id != '' ? oldcountry_id : "{{$city->country_code}}" );

		var oldstate_code = "{{old('state_code')}}"; 

		var state_code = (oldstate_code !='' ? oldstate_code : "{{$city->state_code}}");
		
		$.ajax({ 
		      type:"GET",
		      url:"{{route('state')}}?country_id="+country_id,
		      success:function(res)
		      {   		     
		          if(res.length !=0){
		              $("#state").empty();

		              $("#state").append('<option value="0">Select State</option>');
		              $.each(res,function(key,value){
		                  $("#state").append('<option value="'+value.state_code+'"  ' + (value.state_code == state_code ? 'selected="selected"' : '' )+ '>'+value.state_name+'</option>');
		              });
		          }else{
		              $("#state").empty();		              
		          }
		      }
		    });
	});
	</script>
@endsection