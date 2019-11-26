@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12 m-auto">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Course Details <a href="{{route('course.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3> 
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						
						<h4><b>Course  Name:</b> {{ $data->course_desc }}</h4><br>
						<h4><b>Course Duration:</b> {{$data->course->course_duration}} years</h4><br>
					</div>

				</div>	
				
				<div class="row">
					<div class="col-md-12">	
						<hr>
						<h4><b>Syllabus:</b></h4>
						@php echo $data->syllabus @endphp
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
</section>

@endsection