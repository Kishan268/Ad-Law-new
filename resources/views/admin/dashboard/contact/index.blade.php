@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Contact Us Details</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered dataTable" id="myTable">
						<thead>
							<tr class="row">
							
								<th>SNo.</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Mobile</th>							
								<th>Address</th>
								<th>Message</th>
							</tr>
						</thead>
						<tbody>
							<?php $count=0; ?>
							@foreach($contacts as $contact)
							<tr class="row">						
								<td>{{++$count}}</td>
								<td>{{$contact->fname}}</td>
								<td>{{$contact->lname}}</td>
								<td>{{$contact->cemail}}</td>
								<td>{{$contact->mobile_no}}</td>
								<td>{{$contact->address}}</td>
								<td>{{$contact->message}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myTable').DataTable({
        	searching:true,
        	scrolling:true,
		});
	})
</script>
@endsection