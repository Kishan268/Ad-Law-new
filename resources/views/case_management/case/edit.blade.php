@extends('lawfirm.layouts.main')
@section('content')
<section class="content">

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Edit New Case 
					@if($page_name == 'clients')
						<a href="{{route('clients.show',$case->cust_id)}}" class="btn btn-sm btn-info pull-right">Back</a>
					@else
						<a href="{{route('case_mast.index',['caseBtn' =>'cr'])}}" class="btn btn-sm btn-info pull-right">Back</a>
					@endif

				</h3>
			</div>
			<div class="box-body">
				<form action="{{route('case_mast.update',$case->case_id)}}" method="post">
				@csrf
				@method('PATCH')
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px; ">
							<label for="court_type">Court Type Name <span class="text-danger">*</span></label>
							<select class="form-control" name="court_type" id="case_court_type">
								<option value="0" > Select Court Type Name</option>
								@foreach($courts as $court)
									<option value="{{$court->court_type}}" {{old('court_type') == $court->court_type ? 'selected' : ''}} {{$case->court_type == $court->court_type ? 'selected' : ''}} >{{$court->court_type_desc}}</option>
								@endforeach
							</select>
							@error('court_type')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected court type name is invalid." }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row from-group" style="display: none;" id="cnr_div">
						<div class="col-md-6" style="margin-top:10px; ">
							<label for="cnr">Do you have CNR #?</label>
							<input type="radio" name="cnr" value="1" {{old('cnr') == '1' ? 'checked' : ''}}  {{$case->cnr_number != '' ? 'checked' : ''}}>Yes
							<input type="radio" name="cnr" value="0" {{old('cnr') == '0' ? 'checked' : ''}} {{$case->cnr_number == '' ? 'checked' : ''}}>No
						</div>
					</div>
					<div class="row form-group" style="display: none;" id="cnr_number_div">
						<div class="col-md-6" style="margin-top:10px; ">							
							<label for="cnr_number">CNR Number <span class="text-danger">*</span></label>
							<input type="text" name="cnr_number" value="{{old('cnr_number') ?? $case->cnr_number}}" class="form-control text-capitalize">
							@error('cnr_number')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-6" style="margin-top: 10px; display: none" id="no_catg_div">
							<label>Supreme Court Of India <span class="text-danger">*</span></label>
							<select class="form-control" name="no_catg" id="no_catg">
								<option value="0">Select type</option>
								<option value="c_no" {{old('no_catg') == 'c_no' ? 'selected' : ''}} {{$case->c_d_flag == 'c' ? 'selected' : ''}}>Case Number</option>
								<option value="d_no" {{old('no_catg') == 'd_no' ? 'selected' : ''}} {{$case->c_d_flag == 'd' ? 'selected' : ''}}>Diary Number</option>
							</select>
							@error('no_catg')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected supreme court type is invalid." }}</strong>
								</span>
							@enderror
						</div>
				
						<div class="col-md-6" style="margin-top:10px; display: none;" id="court_code_div">
							<label for="court_code" id="court_code_label"></label>
								<select class="form-control" name="court_code" id="court_code">
								
								</select>
							@error('court_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected court name is invalid." }}</strong>
								</span>
							@enderror
						</div>
					</div>	
					<div class="row form-group" style="display: none;" id="state_city_div">
						<div class="col-md-6" style="margin-top:10px;" >
							<label for="state_code">State Name <span class="text-danger">*</span></label>
							<select name="state_code" class="form-control" id="state">
								<option value="0">Select State</option>
								@foreach($states as $state)
									<option value="{{$state->state_code}}" {{old('state_code') == $state->state_code ? 'selected' : ''}} {{$case->state_code == $state->state_code ? 'selected' : ''}}>{{$state->state_name}}</option>
								@endforeach
							</select>
							@error('state_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected state name is invalid" }}</strong>
								</span>
							@enderror
						</div> 
						<div class="col-md-6" style="margin-top:10px;">
							<label for="city_code">City Name <span class="text-danger">*</span></label>
							<select name="city_code" class="form-control" id="city">
																
							</select>
							@error('city_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected city name is invalid" }}</strong>
								</span>
							@enderror
						</div> 
					</div>
					<div class="row from-group" style="" >
						<div class="col-md-6" style="margin-top: 10px; display: none; " id="case_type_div">
							<label for="case_type_id">Case Type <span class="text-danger">*</span></label>
							<select class="form-control" name="case_type_id">
								<option value="0">Select Case Type</option>
								@foreach($case_types as $case_type)

								<option value="{{$case_type->case_type_id}}" {{old('case_type_id')==$case_type->case_type_id ? 'selected' : ''}} {{$case->case_type_id == $case_type->case_type_id ? 'selected' : ''}}>{{$case_type->case_type_desc}}</option>									    
								@endforeach
							</select>
							@error('case_type_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected case type is invalid" }}</strong>
								</span>
							@enderror
						</div>
					
						<div class="col-md-6" style="margin-top:10px; display: none; " id="no_div">
							<label for="c_d_number" id="no_label"> </label>
							<input type="text" name="c_d_number" class="form-control" placeholder="Number" value="{{old('c_d_number') ?? $case->c_d_number}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
							@error('c_d_number')
								<span class="invalid-feedback text-danger" role="alert">
								<strong id="err_c_d_number"> {{ $message }}</strong>
								</span>
							@enderror
						</div>
					
					</div>

					<div class="row form-group">

						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_reg_date">Case Registration Date <span class="text-danger">*</span></label>
							<input type="text" value="{{old('case_reg_date') ?? $case->case_reg_date}}" class="form-control " name="case_reg_date" required autocomplete="case_reg_date" autofocus  id="regdatepicker" placeholder="Enter case registration date "  data-date-format="yyyy-mm-dd">
							@error('case_reg_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
											
						<div class="col-md-6" style="margin-top:10px; ">
							<label for="case_title">Case Title <span class="text-danger">*</span></label>
							<input type="text" name="case_title" class="form-control" placeholder="Enter Case Title" value="{{ old('case_title') ?? $case->case_title}}" aria-required="true" aria-invalid="true">
							@error('case_title')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>					
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="catg_code">Case Category <span class="text-danger">*</span></label>
							<select class="form-control" name="catg_code" id="case_category">
								<option value="0">Select case category</option>
								@foreach($categories as $category)
							    
							    	<option value="{{$category->catg_code}}" {{old('catg_code')==$category->catg_code ? 'selected' : ''}} {{$case->catg_code == $category->catg_code ? 'selected' : ''}}>{{$category->catg_desc}}</option>									    
								@endforeach
							</select>
							@error('catg_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected case category is invalid." }}</strong>
								</span>
							@enderror
						</div>
					
						<div class="col-md-6" style="margin-top:10px;">
							<label for="subcatg_code">Case Subcategory <span class="text-danger">*</span></label>
							<select class="form-control" name="subcatg_code" id="case_subcategory">
							
							</select>
							@error('subcatg_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected case subcategory is invalid." }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="appellant_name">Appellant Name</label>
							<input type="text" name="appellant_name" class="form-control" placeholder="Enter Appellant Name" value="{{ old('appellant_name') ?? $case->appellant_name}}" >
							@error('appellant_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px;">
							<label for="respondant_name">Respondant Name</label>
							<input type="text" name="respondant_name" class="form-control" placeholder="Enter Respondant Name" value="{{ old('respondant_name') ?? $case->respondant_name }}">
							@error('respondant_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12" style="margin-top:10px;">
							<label for="client_name">Client Name <span class="text-danger">*</span></label>
						
								<select class="form-control" name="cust_id">
									<option value="0"> Select Client Name</option>
									@foreach($clients as $client)
										<option value="{{$client->cust_id}}" {{old('cust_id') == $client->cust_id ? 'selected' : ''}} {{$case->cust_id == $client->cust_id ? 'selected' : ''}}>{{$client->cust_name}}</option>
									@endforeach
								</select>
							

							@error('cust_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected customer name is invalid." }}</strong>
								</span>
							@enderror
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col-md-6" style="margin-top: 10px;">
							<label for="affidavit_status">Is the affidavit/vakalath filed?</label>
							<input type="radio" name="affidavit_status" value="1" {{old('affidavit_status') == '1' ? 'checked' : ''}} {{$case->affidavit_date != '' ? 'checked' : '' }}> Yes
							<input type="radio" name="affidavit_status" value="0" {{old('affidavit_status') == '0' ? 'checked' : ''}}  {{$case->affidavit_date == '' ? 'checked' : '' }}> No
							
						</div>
					</div>
					<div class="row form-group" >
						<div class="col-md-6" style="margin-top: 10px; display: none;" id="affidavit_date_div">
							<label for="affidavit_date">Affidavit Date <span class="text-danger">*</span></label>
							<input type="text" name="affidavit_date" class="form-control" placeholder="Enter Affidavit Date" id="affidavit_date" data-date-format="yyyy-mm-dd"  value="{{old('affidavit_date') ?? $case->affidavit_date}}">
							@error('affidavit_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror

						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_fees">Case Fees </label><span class="text-muted">(Case fees format ex. 1000.00)</span>
							<input type="text" name="case_fees" class="form-control" placeholder="Enter Case Fees" value="{{ old('case_fees') ?? $case->case_fees}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
							@error('case_fees')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_status">Case Status <span class="text-danger">*</span></label>
							<select class="form-control" name="case_status">
								@foreach($case_status as $case_st)
									<option value="{{$case_st->case_status_id}}" {{old('case_status') == $case_st->case_status_id  ? 'selected' : ''}} {{$case->case_status == $case_st->case_status_id ? 'selected' : ''}}>{{$case_st->case_status_desc}}</option>
								@endforeach
							</select>
							@error('case_status')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px; display: none;"  id="caseOverDate">							
								<label for="case_over_date">Case Over Date <span class="text-danger">*</span></label>
								<input type="text" value="{{old('case_over_date') ?? $case->case_over_date}}" class="form-control" name="case_over_date" id="datepicker" data-date-format="yyyy-mm-dd" placeholder="Case over date" >
								
							
								@error('case_over_date')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
								
							 
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col-md-12" style="margin-top:10px;">
							<label for="case_description">Case Description <span class="text-danger">*</span> </label> <span class="text-muted form-text">(Brief details about the case as explained by the customer</span>
							<textarea name="case_description" rows="5" cols="50" class="form-control tinymce"   id="summernote" >{{old('case_description') ?? $case->case_description}}</textarea>
							@error('case_description')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
							
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top: 10px;">
							<label for="team_id">Team Name </label><span class="text-muted"></span>
							<select class="form-control" name="team_id" id="team">
								<option value="0" {{$case->team_id == '0' ? 'selected' : ''}}> ---- All ----</option>	
								@foreach($teams as $team)
									<option value="{{$team->id}}" {{old('team_id') == $team->id ? 'selected' : ''}} {{$case->team_id == $team->id ? 'selected' : ''}}>{{$team->name}}</option>
								@endforeach							
							</select>
 						</div>
						<div class="col-md-6" style="margin-top: 10px;">
							<label for="users_id">User Name <span class="text-danger">*</span> </label> <span class="text-muted">(Case assign to users)</span>
							<select class="form-control select2 team_users" name="users_id[]" multiple="multiple">
									@if($case->team_id == 0)
										<option value="{{Auth::user()->id}}" {{ (collect(old('team_id'))->contains(Auth::user()->id)) ? 'selected':'selected' }}   locked="locked">{{Auth::user()->name}}</option>
									@endif
									@foreach($members as $member)								
										<option value="{{$case->team_id != '0' ? $member->user_id : $member->id}}" 
											@if(count(collect(old('team_id'))) == '0')
												@foreach($assign_mem as $assign_m) 
														{{$assign_m->user_id1 == ($case->team_id != '0' ? $member->user_id : $member->id) ? 'selected' : ''}}
												@endforeach
											@else
												{{ (collect(old('team_id'))->contains($case->team_id != '0' ? $member->user_id : $member->id)) ? 'selected': '' }}
											@endif
										>{{$case->team_id != '0' ? $member->users->name : $member->name}}</option>
										
									@endforeach
								
							</select>
							@error('users_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "User field is required" }}</strong>
								</span>
							@enderror

						</div>
					</div>


					<div class="row form-group">				
						<div class="col-md-12" style="margin-top:10px;">
													
							<input type="hidden" name="page_name" value="{{$page_name}}" >
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
$(document).ready(function(){		
	$('.select2').select2({
		 tags: true,
	     placeholder: 'Select an option',
	     templateSelection : function (tag, container){
	     	
	      	var $option = $('.select2 option[value="'+tag.id+'"]');
	        if ($option.attr('locked')){
	           $(container).addClass('locked-tag');
	           tag.locked = true; 
	        }
	        return tag.text;
	     },
	   })
	   .on('select2:unselecting', function(e){
	   
	       if ($(e.params.args.data.element).attr('locked')) {
	           e.preventDefault();
	        }
	     });	
		
	$(function () {
		$("#datepicker,#affidavit_date,#regdatepicker").datepicker();
	});


	$('input[name="affidavit_status"]').on('change',function(e){
		var status = $(this).val();
		if(status == '0'){
			$('#affidavit_date_div').hide();
		}
		else{
			$('#affidavit_date_div').show();
		}

	});
	var affidavit_status = $('input[name="affidavit_status"]:checked').val(); 

	if(affidavit_status == '0'){
			$('#affidavit_date_div').hide();
		}
		else{
			$('#affidavit_date_div').show();
		}

	$("select[name='case_status']").on('change',function(e){
		e.preventDefault();
	 	var case_status = $(this).val();
	 	// console.log(case_status);
		if(case_status == 'cr' ){
			$('#caseOverDate').hide();
		}
		else {
			$('#caseOverDate').show();
		}
	});

	var case_status = "{{old('case_status') != '' ? old('case_status') : $case->case_status }}";

	if(case_status == 'cr'  ){
		$('#caseOverDate').hide();
	}
	else {
		$('#caseOverDate').show();
	}


	$('#case_category').on('change',function(){
		var catg_code = $(this).val();  
		// console.log(catg_code);  
		var subcatg_code = "";
		case_subcategory(catg_code,subcatg_code);
	});
		
	var catg_code = ("{{old('catg_code')}}" == '' ? "{{$case->catg_code}}" : "{{old('catg_code')}}" );
    var subcatg_code = ("{{old('subcatg_code')}}" == '' ? "{{$case->subcatg_code}}" : "{{old('subcatg_code')}}");

    if(catg_code !=0){
    	case_subcategory(catg_code,subcatg_code);
    }

	$('#state').on('change',function(e){
		e.preventDefault();
		var state_code = $(this).val();
		var city_code = "";
		state(state_code, city_code);
	});
	var state_code =("{{old('state_code')}}" == '' ? "{{$case->state_code}}" : "{{old('state_code')}}" );  
	var city_code = ("{{old('city_code')}}" == '' ? "{{$case->city_code}}" : "{{old('city_code')}}" );
	if(state_code !=''){
		state(state_code, city_code);
	}

	var court_type = ("{{old('court_type')}}"
		!= '' ? "{{old('court_type')}}" : "{{$case->court_type}}");

	if(court_type !=''){
		var court_code =  ("{{old('court_code')}}"
		!= '' ? "{{old('court_code')}}" : "{{$case->court_code}}");

		var no_catg_edit = $('#no_catg').val();

		var no_catg = ("{{old('no_catg')}}" == '' ? no_catg_edit : "{{old('no_catg')}}");

		var cnr_edit =  $('input[name="cnr"]:checked').val();
		var cnr = ("{{old('cnr')}}" == '' ? cnr_edit : "{{old('cnr')}}");

		case_court_select(court_code, court_type, no_catg, cnr);
		$("#case_court_type").on('change',function(e){
			var court_type = $(this).val();
			var court_code = "";
			var no_catg = "";
			var cnr = "";
			case_court_select(court_code, court_type, no_catg, cnr);
		});
	}
	else{
		
		$("#case_court_type").on('change',function(e){
			var court_type = $(this).val();
			var court_code = "";
			var no_catg = "";
			var cnr = "";
			case_court_select(court_code, court_type, no_catg, cnr);
		});
	}


	var auth_id = "{{Auth::user()->id}}";
	var auth_name = "{{Auth::user()->name}}";	

	$('#team').on('change',function(e){
		var team_id = $(this).val();
		team_users(team_id,auth_id,auth_name);	
	});



});
</script>
@endsection