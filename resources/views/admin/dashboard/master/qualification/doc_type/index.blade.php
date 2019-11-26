@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Qualification Document Type({{count($doc_types)}}) <a href="{{route('qual_doc_type.create')}}" class="btn btn-sm btn-primary pull-right">Add Profession</a></h3>
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
								<th>Qualification Document Type Name</th>
								<th>Short Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>	
							@php $count = '0' @endphp								
							@foreach($doc_types as $doc_type)
								<tr>
									<td>{{$doc_type->id}}</td>
									<td>{{$doc_type->name}}</td>
									<td>{{$doc_type->shrt_desc}}</td>
									<td>
										<form action="{{route('qual_doc_type.destroy', ['id' =>  $doc_type->id ])}}" method="POST" id="delform_{{ $doc_type->id }}">
										@method('DELETE')

									 	<a href="{{route('qual_doc_type.edit',$doc_type->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

									 	<a href="javascript:$('#delform_{{ $doc_type->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
									 	@csrf
										</form>
									</td>
								</tr>							
							@endforeach
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