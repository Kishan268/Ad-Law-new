@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Document Mast <a href="{{route('qual_doc_mast.create')}}" class="btn btn-sm btn-primary pull-right">Add Document </a></h3>
				</div>
				<div class="box-body">
					@if($message = Session::get('success'))
						<div class="alert bg-success">
							{{$message}}
						</div>
					@endif
					<table class="table table-striped table-bordered" id="myTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Qualification Category</th>
								<th>Document Type</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>	
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script >
	$(document).ready(function(){		
		$('#myTable').DataTable();
    });
</script>
@endsection