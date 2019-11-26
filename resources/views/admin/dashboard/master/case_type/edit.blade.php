 <span class="text-danger">*</span>@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Case Type <a href="{{route('case_type.index')}}" class="btn btn-sm btn-primary pull-right" >Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('case_type.update',['id'=>$case_type->case_type_id])}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6">
									<label>Court Type Name</label>
									<select class="form-control" name="court_type" id="court_type">
										<option value="0">Select Court Type <span class="text-danger">*</span></option>
										@foreach($court_types as $court_type)
											<option value="{{$court_type->court_type}}" {{old('court_type') == $court_type->court_type ? 'selected' : '' }} {{$case_type->court_type == $court_type->court_type ? 'selected' : ''}}>{{$court_type->court_type_desc}}</option>
										@endforeach 
									</select>
									@error('court_type')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
									
								</div>								
								<div class="col-md-6 courtDiv"  >
									<label>Court Name <span class="text-danger">*</span></label>
									<select class="form-control" name="court_code" id="court" >
									
									</select>
									@error('court_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
									
								</div>								
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label> Case Type Name <span class="text-danger">*</span></label>
									<input type="text" name="case_type_desc" class="form-control" placeholder="Enter Caste Type Name" value="{{$case_type->case_type_desc}}" >
									@error('case_type_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>		
														
							</div>
							<div class="row form-group">
								<div class="col-md-12">
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
			// $("select[name='country_code'],select[name='state_code']").select2();
		

		$("#court_type").on('change',function(e){
		  	e.preventDefault();
		  	var court_type = $(this).val();
		
		    $.ajax({ 
		      type:"Post",
		      url:"{{route('courtFilter')}}",
		      data : {court_type:court_type},
		      success:function(res)
		      {   	
		      // alert(res);
		      // console.log(res);

		          if(res.length !=0){
		              $("#court").empty();

		              $("#court").append('<option value="0">Select Court </option>');
		              $.each(res,function(key,value){
		                  $("#court").append('<option value="'+value.court_code+'">'+value.court_name+'</option>');
		              });
		          }else{
		              $("#court").empty();		              
		          }
		      }
		    });
		});

		var oldcourt_type = "{{old('court_type')}}";

		if(oldcourt_type !=''){
			var court_type = oldcourt_type;
		}
		else{
			var court_type = "{{$case_type->court_type}}";
		}

		var old_court_code = "{{old('court_code')}}";

		if(old_court_code != '' ){
			var court_code = old_court_code;
		}
		else{
			var court_code ="{{$case_type->court_code}}";
		}

		if(court_type != '' ){
		    $.ajax({ 
		      type:"Post",
		      url:"{{route('courtFilter')}}",
		      data : {court_type:court_type},
		      success:function(res){   
				if(res.length !=0){
				  $("#court").empty();

				  $("#court").append('<option value="0">Select Court </option>');
				  $.each(res,function(key,value){
				      $("#court").append('<option value="'+value.court_code+'" '+(court_code == value.court_code ? 'selected="selected"' : '')+' >'+value.court_name+'</option>');
				  });
				}else{
				  $("#court").empty();		              
				}
		      }
		    });
		 }



		
	});
	</script>
@endsection