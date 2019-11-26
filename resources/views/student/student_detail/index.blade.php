@extends('lawschools.layouts.main')
@section('content')
<section class="content">
@include('student.header')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student List</h4>
			</div>
			<div class="panel-body">				
				<div class="row">
					<div class="col-md-8">
						<div class="row form-group">
							<div class="col-md-3">
								<select class="form-control" name="batch">
									<option value="">Select Batch</option>
									@foreach($batches as $batch)
										<option value="{{$batch->id}}">{{$batch->name}}</option>
									@endforeach 
								</select>
							</div>
							<div class="col-md-3">
								<select class="form-control" name="year"> 
									<option value="">Select Admission Year</option>
									<option value="1">1 year</option>
									<option value="2">2 year</option>
									<option value="3">3 year</option>
									<option value="4">4 year</option>
									<option value="5">5 year</option>

								</select>
							</div>
							<div class="col-md-3">
								<select class="form-control" name="semester"> 
									<option value="">Select Semester</option>
									<option value="1">1st</option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
									<option value="6">6th</option>
									<option value="7">7th</option>
									<option value="8">8th</option>
									<option value="9">9th</option>
									<option value="10">10th</option>
								</select>
							</div>
							<div class="col-md-3">
								<button class="btn btn-sm btn-primary" id="btnFilter">Filter</button>
							</div>
						</div>			
					</div>
					<div class="col-md-4">

						<span><b>Search &nbsp;</b></span><input type="text" name="search" >
						<a href="{{route('student_detail.create')}}" class="btn btn-sm btn-success pull-right">Add Student</a>
					</div>

				</div>
				<br>
				<div class="row">
					<div class="col-md-12" id="tableFilter">
						@include('student.student_detail.table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){
		$('#btnFilter').on('click',function(e){
			e.preventDefault();
			var batch_id = $('select[name="batch"] option:selected').val();
			var qual_year = $('select[name="year"] option:selected').val();
			var semester = $('select[name="semester"] option:selected').val();
			if(batch_id !='' && qual_year != '' && semester !='' ){
				$.ajax({
					type:'POST',
					url: "{{route('student_filter')}}",
					data: {batch_id:batch_id,qual_year:qual_year,semester:semester},
					success:function(res){
						$('#tableFilter').empty().html(res);
					}
				});
			}else{
				alert('please select all field');
			}

		});
	});
</script>
@endsection