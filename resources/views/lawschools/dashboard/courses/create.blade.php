@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 style="margin-top: 10px;">Add Course <a href="{{route('course.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3>
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
							<label for="course_code">Course Name<span class="text-danger">*</span></label>
							<select name="course_code" class="form-control" id="course_catg">
								<option value="0">Select course name</option>
								@foreach($courses as $course)
									<option value="{{$course->course_code}}" {{old('course_code') == $course->course_code ? 'selected' : ''}}>{{$course->course_desc}}</option>
								@endforeach
								
							</select>
							@error('course_code')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
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
<script type="text/javascript">

	$(document).ready(function(){



		tinymce.init({
		/* replace textarea having class .tinymce with tinymce editor */
			selector: "textarea.tinymce",
			// theme: "modern",
			// skin: "lightgray",
			plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
			
			"   directionality emoticons template paste textcolor"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor ",

			height: 300,
		});

		});


</script>


@endsection
