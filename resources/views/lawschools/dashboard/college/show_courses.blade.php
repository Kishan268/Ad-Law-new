@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 class="box-title">College Courses</h3>
			</div>
			<div class="box-body table-responsive" >
				
				<table class="table table-hover table-striped table-bordered"  id="ClientsTable">
					<thead>
						<tr>
							<th>SNo.</th>
							<th>Course Type</th>
							<th>Course Name</th>
							<th>Course Duration</th>
					
							<th>View</th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 0; ?>

						@foreach($courses as $course)
						<tr>
							<td>{{++$count}}</td>

							<td>{{$course->qual_catg_desc}}</td>

							<!-- <td><?php //echo date('d-m-Y', strtotime($client->regsdate)); ?></td>
 -->
							<td>{{$course->qual_desc}}</td>

							<td >{{$course->qual_duration}}-{{$course->qual_unit}}</td>
					
							<td><a href="{{route('lawschools.show_course_details', $course->id)}}" class="btn btn-sm btn-success">View</a></td>

						</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
</section>

<script>
	$(document).ready(function(){
		$('#ClientsTable').DataTable();
	});
</script>
@endsection