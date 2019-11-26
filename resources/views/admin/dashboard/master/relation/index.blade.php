@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Relation({{count($relations)}}) <a href="{{route('relation.create')}}" class="btn btn-sm btn-primary pull-right">Add Relation</a></h3>
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
								<th>Relation Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>	
							@php $count = '0' @endphp								
							@foreach($relations as $relation)
								<tr>
									<td>{{$relation->id}}</td>
									<td>{{$relation->name}}</td>
									<td>
										<form action="{{route('relation.destroy', ['id' =>  $relation->id ])}}" method="POST" id="delform_{{ $relation->id }}">
										@method('DELETE')

									 	<a href="{{route('relation.edit',$relation->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

									 	<a href="javascript:$('#delform_{{ $relation->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
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