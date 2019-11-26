@extends(Auth::user()->user_catg_id==2 ? 'lawfirm.layouts.main' :'lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<form action="{{route('qualification.store')}}" method="post">
				{{csrf_field()}}
				<div class="row form-group" >
					<div class="col-md-6"  style="margin-top:10px;" >
						<label>Course Type <span class="text-danger">*</span></label>
						<select class="form-control" name="qual_catg_code" id="qual_catg_code">
							<option value="0">Select course type</option>
							@foreach($qual_catgs as $qual_catg)
								<option value="{{$qual_catg->qual_catg_code}}" {{old('qual_catg_code') == $qual_catg->qual_catg_code  ? 'selected' :  ''}} > {{$qual_catg->qual_catg_desc}}</option>
							@endforeach
						</select>

						@error('qual_catg_code')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top:10px;"> 
						<label for="qual_code">Course Name <span class="text-danger">*</span></label>
						<select class="form-control" name="qual_code" id="course_catg">
						</select>
						@error('qual_code')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;"> 
						<label>Passing Year <span class="text-danger">*</span></label>
						<input type="text" name="pass_year" placeholder="Enter passing year" class="form-control" value="{{old('pass_year')}}">
						@error('pass_year')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top:10px;"> 
						<label for="pass_perc">Passing Percentage <span class="text-danger">*</span></label>
						<input type="text" name="pass_perc" placeholder="Enter passing Percentage" class="form-control" value="{{old('pass_perc')}}">
						@error('pass_perc')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
						
				</div>
				<div class="row form-group">
					<div class="col-md-6" style="margin-top:10px;">
						<label for="pass_division">Passing Division <span class="text-danger">*</span></label>
						<select name="pass_division" class="form-control">
							<option value="0">Select Division</option>
							<option value="1" {{old('pass_division')=='1' ? 'selected' : '' }}>1st</option>
							<option value="2" {{old('pass_division')=='2' ? 'selected' : '' }}>2nd</option>
							<option value="3" {{old('pass_division')=='3' ? 'selected' : '' }}>3rd</option>
						</select>
						@error('pass_division')
							<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top:10px;">
						<button class="btn btn-md btn-primary" class="form-control" id="submit1">Submit</button>
					</div>
				</div>
			</form>
			</div>
		</div>
			
	</div>
		<div class="col-md-12 ">
			<div class="box box-primary">
				<div class="box-header with-border" >
					<h3 style="margin-top: 10px;">Your Qualification</h3>
				</div>
			<div class="box-body table-responsive ">
				<table id="qualification" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Course Type</th>
								<th>Course Name</th>
								<th>Passing Year</th>
								<th>Passing Percentage</th>
								<th>Passing Division</th>
							</tr>							
						</thead>
						<tbody>
							@php $count = 0; @endphp
							@foreach($qualis as $quali)
							<tr>
								<td>{{ ++$count }}</td>
								<td>{{ $quali->qual_catg_desc }}</td>
								<td>{{ $quali->qual_desc }}</td>
								<td>{{ $quali->pass_year }}</td>
								<td>{{ $quali->pass_perc }}</td>
								<td>{{ $quali->pass_division}}</td>	
							</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
		
	</div>
</section>
@if($message = Session::get('warning'))
	<script type="text/javascript">
		var messsge = "{{$message}}";
		alert(messsge);
	</script>
@endif
@if($message = Session::get('success'))
	<script type="text/javascript">
		var messsge = "{{$message}}";
		alert(messsge);
	</script>
@endif

<script type="text/javascript">

	$(document).ready(function(){
		$('#qualification').DataTable();
	});

	$(document).ready(function(){


		$('#qual_catg_code').on('change',function(){
			var qual_catg_code = $(this).val();
			
			if(qual_catg_code!=0){
				$.ajax({
					type:'GET',
					url:'{{route("qual.category")}}?qual_catg_code='+qual_catg_code,
					success:function(data){
						
						if(data){
							  $("#course_catg").empty();
							$('#course_catg').append('<option value="0">Select Course Name</option>');
							$.each(data, function(key,value){
								$("#course_catg").append('<option value="'+value.qual_code+'">'+value.qual_desc+'</option>');
							});
						}
						else{
							$('#course_catg').empty();
						}
					}
				});
			}
			else{
				$('#course_catg').empty();
			}
			
		});
	
var qual_catg_code  = $('select[name="qual_catg_code"] option:selected').val();

var old_qual = "{{old('qual_code')}}";

// console.log(qual_catg_code);
// console.log(old_qual);

	if(qual_catg_code!=0){
		$.ajax({
			type:'GET',
			url:'{{route("qual.category")}}?qual_catg_code='+qual_catg_code,
			success:function(data){
				
				if(data){
					  $("#course_catg").empty();
					$('#course_catg').append('<option value="0">Select Course Name</option>');
					$.each(data, function(key,value){
						$("#course_catg").append('<option value="'+value.qual_code+'" '+ (value.qual_code == old_qual ? 'selected' : '') +' >'+value.qual_desc+'</option>');
					});
				}
				else{
					$('#course_catg').empty();
				}
			}
		});
	}
	else{
		$('#course_catg').empty();
	}

	});
</script>

@endsection