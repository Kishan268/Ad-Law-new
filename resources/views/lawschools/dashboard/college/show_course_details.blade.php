@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12 m-auto">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Course Details <a href="" class="btn btn-sm btn-info pull-right">Back</a></h3> 
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<h5><b>Course Type:</b> {{$course_details->qual_catg_desc}}</h5><br>
						<h5><b>Course  Name:</b> {{ $course_details->qual_desc }}</h5><br>
						<h5><b>Course Duration:</b> {{$course_details->qual_duration}}-{{$course_details->qual_unit}}</h5><br>
					</div>

				</div>	
				
				<div class="row">
					<div class="col-md-12">	
						<hr>
						<h5><b>Syllabus:</b></h5>
						@php echo $course_details->qual_syllabus @endphp
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
</section>

@endsection
