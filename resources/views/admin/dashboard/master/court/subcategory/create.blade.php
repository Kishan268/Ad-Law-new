@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Create Court <a href="{{route('court_subcategory.index')}}" class="btn btn-sm btn-primary pull-right" >Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('court_subcategory.store')}} " method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6">
									<label>Court Group Name <span class="text-danger">*</span></label>
									<select name="court_group_code" class="form-control" id="court_group">
										<option value="0">Select Group Name</option>
										@foreach($courtgrups as $courtgrup)
											<option value="{{$courtgrup->court_group_code}}" {{old('court_group_code') == $courtgrup->court_group_code ? 'selected' : '' }}>{{$courtgrup->court_group_name}}</option>
										@endforeach
									</select>
									@error('court_group_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
						
								<div class="col-md-6">
									<label>Court Type Name <span class="text-danger">*</span></label>
									<select name="court_type" class="form-control" id="court_type">
									
									</select>
									@error('court_type')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label>Court Name <span class="text-danger">*</span></label>
									<input type="text" name="court_name" value="{{old('court_name')}}" class="form-control">
									@error('court_name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6">
									<label>Court Short Name</label>
									<input type="text" name="court_shrt_name" value="{{old('court_shrt_name')}}" class="form-control">
									@error('court_shrt_name')
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


		$("#court_group").on('change',function(e){
		  	e.preventDefault();
		  	var court_group_code = $('#court_group').val();
		    $.ajax({ 
		      type:"Post",
		      url:"{{route('courtTypeFilter')}}",
		      data : {court_group_code:court_group_code},
		      success:function(res)
		      {   	
		      // alert(res);
		      // console.log(res);

		          if(res.length !=0){
		              $("#court_type").empty();

		              $("#court_type").append('<option value="0">Select Court Type</option>');
		              $.each(res,function(key,value){
		                  $("#court_type").append('<option value="'+value.court_type+'">'+value.court_type_desc+'</option>');
		              });
		          }else{
		              $("#court_type").empty();		              
		          }
		      }
		    });
		});

		var court_group_code = "{{old('court_group_code')}}";
		if(court_group_code != '' ){
		    $.ajax({ 
		      type:"Post",
		      url:"{{route('courtTypeFilter')}}",
		      data : {court_group_code:court_group_code},
		      success:function(res)
		      {   	
		     

		          if(res.length !=0){
		              $("#court_type").empty();

		              $("#court_type").append('<option value="0">Select Court Type</option>');
		              $.each(res,function(key,value){
		                  $("#court_type").append('<option value="'+value.court_type+'">'+value.court_type_desc+'</option>');
		              });
		          }else{
		              $("#court_type").empty();		              
		          }
		      }
		    });
		 }
		
	});
	</script>
@endsection