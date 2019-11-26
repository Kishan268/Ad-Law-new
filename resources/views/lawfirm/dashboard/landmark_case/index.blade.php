@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="box box-primary" >
			<div class="box-header with-border">
				<h3 class="box-title">Create Judgment </h3>
			</div>
			<div class="box-body">
				<form>
				@csrf
				<div class="row form-group">
					<div class="col-md-3">
						<label >Judgment Title <span class="text-danger" >*</span></label>
						<input required type="text " name="judgment_title" class="form-control" placeholder="Judgmental Title" value="{{old('judgment_title')}}" >
						<span class="invalid-feedback text-danger" role="alert">
	                        <strong id="title_error"></strong>
	                    </span>
					</div>
					<div class="col-md-3">
						<label>Court Types<span class="text-danger" >*</span></label>
						<select class="form-control" name="court_type" id="court_type">
							<option value="0" selected="true" disabled="true" >Select court types</option>
							@foreach ($courtTypes as $courtType)
								<option value="{{$courtType->court_type}}">{{$courtType->court_type_desc}}</option>
							@endforeach
						</select>
						<span class="invalid-feedback text-danger" role="alert">
	                        <strong id="court_type_error"></strong>
	                    </span>						
					</div>
					<div class="col-md-3" id="court_code_div">
						<label>Court Name<span class="text-danger" >*</span></label>
						<select class="form-control" name="court_code" id="court_code">
							
						</select>
						<span class="invalid-feedback text-danger" role="alert">
	                        <strong id="court_code_error"></strong>
	                    </span>
						
					</div>
					<div class="col-md-3">
						<label>Select Case Category <span class="text-danger" >*</span></label>
						<select class="form-control" name="catg_code">
							<option value="0" selected="true" disabled="true">Select Case Category</option>
							@foreach ($case_catgs as $case_catg)
								<option value="{{$case_catg->catg_code}}">{{$case_catg->catg_desc}}</option>
							@endforeach
						</select>						
						<span class="invalid-feedback text-danger" role="alert">
	                        <strong id="case_error"></strong>
	                    </span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<label>Select Judgment Date <span class="text-danger" >*</span></label>
						<input required type="text" name="judgment_date" id="datepicker" data-date-format="yyyy-mm-dd"  class="form-control">
						<span class="invalid-feedback text-danger" role="alert">
	                        <strong id="date_error"></strong>
	                    </span>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12 text-center">
						<button data-toggle="modal" class="btn btn-md btn-primary" id="check_first">Submit</button>
					</div>
				</div>
				</form>
				<div id="myModal" class="modal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								<h3 class="modal-title">Check Details</h3>
							</div>
							<div class="modal-body">
								<div class="row form-group">
									<div class="col-md-3"><label >Judgment Title</label></div>
									<div class="col-md-9"><input class="form-control" readonly="true" id="judgment" type="text" name=""></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"><label >Court Type</label></div>
									<div class="col-md-9"><input class="form-control" readonly="true" id="court_type_desc" type="text" name=""></div>
								</div>
								<div class="row form-group">
									<div class="col-md-3"><label >Court Name</label></div>
									<div class="col-md-9"><input class="form-control" readonly="true" id="court_name" type="text" name=""></div>
								</div>
									<div class="row form-group">
									<div class="col-md-3"><label >Case Category</label></div>
									<div class="col-md-9"><input class="form-control" readonly="true" id="case_catger" type="text" name=""></div>
								</div>
									<div class="row form-group">
									<div class="col-md-3"><label >Judgment Date</label></div>
									<div class="col-md-9"><input class="form-control" readonly="true" id="judgment_date" type="text" name=""></div>
								</div>

								
							</div>
							<div class="modal-footer">
								<button type="button" id="submit" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row "> 
 	<div class="col-md-12">
 		<div class="box box-primary">
 			<div class="box-header with-border">
 				<h3 class="box-title">Judments</h3>
 			</div>
 			<div class="box-body table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr class="row">
							<th>SNo.</th>
							<th>Judgment Title</th>
							<th>Court Name</th>
							<th>Case Name</th>
							<th>Judgment Date</th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 0 ; ?>
						@foreach($user_judgments as $user_judgment)
						<tr class="row">
							<td>{{++$count}}</td>
							<td>{{ $user_judgment->judgment_title }}</td>
							<td>{{ $user_judgment->court_name }}</td>
							<td>{{ $user_judgment->catg_desc }}</td>
							<td>{{ $user_judgment->judgment_date }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{$user_judgments->links()}}
 			</div>
 		</div>		
	</div>
</div>
</section>	
<script type="text/javascript">

$(document).ready(function() {
	
	$(function () {
	  $("#datepicker").datepicker({ 
	         singleDatePicker: true,
	 		 showDropdowns: true,
	   });
	 });

	$("#court_type").on('change',function(e){
		e.preventDefault();
		var court_type = $(this).val();
		var court_code = "";
		if(court_type =='1' || court_type =='2'){
			// $('#court_code_div').show();
			court(court_type,court_code);

		}
		else{
			// $('#court_code_div').hide();
		}
		
	});

	$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
	});


	$('#check_first').on('click',function(e){
		e.preventDefault();
		var judgment_title 	= $('input[name="judgment_title"]').val(); 
		var court_type 		= $('select[name="court_type"] option:selected').val();
		var court_type_desc = $('select[name="court_type"] option:selected').text();

		var court_code 		= $('select[name="court_code"] option:selected').val();
		var court_name 		= $('select[name="court_code"] option:selected').text();

		var catg_code  		= $('select[name="catg_code"] option:selected').val();
		var catg_desc 		= $('select[name="catg_code"] option:selected').text();
		var judgment_date	= $('input[name="judgment_date"]').val();

		if(judgment_title != '' && judgment_date != '' && court_type !='0' && court_code =='0' && catg_code != '0'){
			$('#judgment').val(judgment_title);
			$('#court_type_desc').val(court_type_desc);
			$('#court_name').val(court_name);
			$('#case_catger').val(catg_desc); 
			$('#judgment_date').val(judgment_date);
			$('#myModal').modal('show');

			$('#submit').on('click', function(e){
				$.ajax({
					type:'POST',
					url: "{{route('landmarkcase.store')}}",
					data: {judgment_title:judgment_title,court_type:court_type, court_type_desc:court_type_desc, court_code:court_code,court_name:court_name, catg_code:catg_code, catg_desc:catg_desc, judgment_date:judgment_date},
					success:function(data){
						$('#myModal').modal('hide');
						swal({
			                    text: data,
			                    icon : 'success',
			                  });
			                  setTimeout(function(){
			                     location.reload(); 
			                  }, 3000); 
			        },
					error:function(data){
						alert(data);
						console.log(data);
					}

					 
				});
			});


		}
		else{
			if(judgment_title == ''){
				$('#title_error').text('The judgment title field is required.');
			}
			else if(court_type =='0'){
				$('#court_type_error').text('The selected court type field is invalid.');
			}
			else if(court_code == '0'){
				$('#court_code_error').text('The selected court name field is invalid.');
			}
			else if(catg_code == '0'){
				$('#case_error').text('The selected case category field is invalid.');
			}
			else{
				$('#date_error').text('The judgment date field is required.');
			}
		}
	});


	// $('#submit').on('click', function(e){
	// 	e.preventDefault();
	// 	var judgment_title 	= $('input[name="judgment_title"]').val(); 
	// 	var court_type 		= $('select[name="court_type"] option:selected').val();
	// 	var court_type_desc = $('select[name="court_type"] option:selected').val();

	// 	var court_code 		= $('select[name="court_code"] option:selected').val();
	// 	var court_name 		= $('select[name="court_code"] option:selected').text();

	// 	var catg_code  		= $('select[name="catg_code"] option:selected').val();
	// 	var catg_desc 		= $('select[name="catg_code"] option:selected').text();
	// 	var judgment_date	= $('input[name="judgment_date"]').val();


	// 	if(judgment_title != '' && court_type !='0' && court_code !='0' && catg_code !='0' && judgment_date != ''   ){
			
	// 	}
	// 	else{
	// 		swal({
	// 				text: 'Select all field',
	//               	icon:"warning",
 //              });
			
	// 	}
	  	
	// });
});
</script>
@endsection