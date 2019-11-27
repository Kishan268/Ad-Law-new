@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 style="margin-top: 10px;">Add Qulification <a href="{{route('course.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3>
			</div>
			<div class="box-body">
				@if($message = Session::get('warning'))
					<div class="alert bg-warning">
						{{$message}}
					</div>
				@endif
				<form  action="{{route('course.store')}}" method="post">
				{{csrf_field()}}
					<div class="row form-group ">				
						<div class="col-md-6" style="margin-top:10px;">	
							<label for="qual_code">Qulification Name<span class="text-danger">*</span></label>
							<select name="qual_catg_code" class="form-control" id="qual_catg_code">
								<option value="">Select</option>
			        				@foreach($courses as $course)
			        				<option value="{{$course->qual_catg_code}}" name ="qual_code">{{$course->qual_catg_desc}}</option>>
			        				@endforeach
							</select>
							@error('qual_catg_code')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
						</div>
						<div class="col-md-6" style="margin-top:10px;">	
							<label for="qual_code">Cource Name<span class="text-danger">*</span></label>
							<select name="qual_code" class="form-control" id="qual_course">
								<option></option>
							</select>
							@error('qual_code')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
						</div>
					</div>

					<div class="row form-group">
			        		<div class="col-md-6 ">
			        			<label for="course_duration">Course Duration<span class="text-danger">*</span></label>
			        			<input type="text" name="course_duration" class="form-control" placeholder="Month" value="{{old('course_duration')}}" id="course_duration">			        			
			        			@error('course_duration')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                       <p><span class="emsg hidden">Please Enter a Valid Name</span></p>
			                    </span>
			                 @enderror
			        		</div>
			        </div>

					<div class="row form-group ">
						<div class="col-sm-12 col-md-12" style="margin-top:10px;">	
							<label for="username">Syllabus <span class="text-danger" >*</span></label>
							<textarea name="syllabus" rows="10" cols="50" class="form-control tinymce" placeholder="About You.."  id="summernote">{{old('syllabus')}}</textarea>

							@error('syllabus')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
						</div>
					</div>
					<div class="row form-group ">
						<div class="col-md-12" style="margin-top:10px;">
							<input type="submit" class="btn btn-md btn-info" value="Submit" id="submitdata">
						</div>
					</div>
				</form>
			</div>			

			</div>
		</div>
	</div>
</section>
{{-- <style type="text/css">
	.emsg{
    color: red;
}
.hidden {
     visibility:hidden;
}
</style> --}}
<script type="text/javascript">

	
$(document).ready(function(){
$('#qual_catg_code').on('change',function(e){
		e.preventDefault();
		var qual_catg_code = $(this).val();
		var qual_code = "";
		qual_course(qual_catg_code,qual_code);
	
	});

   
});
</script>


@endsection
