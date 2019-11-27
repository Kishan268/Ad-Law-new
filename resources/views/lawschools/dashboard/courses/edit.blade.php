@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 style="margin-top: 10px;">Edit Qulification <a href="{{route('course.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3>
			</div>
			<div class="box-body">
				@if($message = Session::get('warning'))
					<div class="alert bg-warning">
						{{$message}}
					</div>
				@endif
				<form  action="{{route('course.update',$data->id)}}" method="post">
				{{csrf_field()}}
				@method('PATCH')
					<div class="row form-group ">				
						<div class="col-md-6" style="margin-top:10px;">	
							<label for="qual_code">Qulification Name<span class="text-danger">*</span></label>
							<select name="qual_catg_code" class="form-control" id="qual_catg_code">
								<option value="0">{{$data->qual_catg_desc}}</option>
								@foreach($courses as $course)
									@foreach($courses as $course)
			        				<option value="{{$course->qual_catg_code}}" name ="qual_code">{{$course->qual_catg_desc}}</option>
			        				@endforeach
								@endforeach
							</select>
							@error('course_code')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
						</div>
						<div class="col-md-6" style="margin-top:10px;">	
							<label for="qual_code">Cource Name<span class="text-danger">*</span></label>
							<select name="qual_code" class="form-control" id="qual_course">
								<option>{{$qual_catg_desc}}</option>
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
			        			<input type="text" name="course_duration" class="form-control" placeholder="Month" value="{{$data->course_duration }}">	
			        			@error('course_duration')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
			        		</div>
			        </div>		
					<div class="row form-group ">
						<div class="col-sm-12 col-md-12" style="margin-top:10px;">	
							<label for="username">Syllabus <span class="text-danger" >*</span></label>
							<textarea name="syllabus" rows="10" cols="50" class="form-control tinymce" placeholder="About You.."  id="summernote">{{old('syllabus') ?? $data->syllabus}}</textarea>

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
	$('#qual_catg_code').on('change',function(e){
			e.preventDefault();
			var qual_catg_code = $(this).val();
			var qual_code = "";
			qual_course(qual_catg_code,qual_code);
		
		});
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
