@extends('lawschools.layouts.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Batches <a href="{{route('batches.create')}}" class="btn btn-sm btn-primary pull-right">Add Batch</a></h3>
					</div>
					<div class="box-body table-responsive">
						@if($message = Session::get('success'))
								<div style="margin-top: 10px;" class="alert bg-success">
									{{$message}}
								</div>
							@endif
						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Batch Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($batches as $batch)
									<tr>
										<td>{{++$count}}</td>
										<td>{{$batch->name}}</td>
										<td>{{$batch->start_date}}</td>
										<td>{{$batch->end_date}}</td>

										
										 <td>
										 	<form action="{{route('batches.destroy', ['id' =>  $batch->id ])}}" method="POST" id="delform_{{ $batch->id }}">
											@method('DELETE')

										 	<a href="{{route('batches.edit',$batch->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="javascript:$('#delform_{{ $batch->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

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
	<script type="text/javascript">
	$(document).ready(function(){		
		$('#myTable').DataTable();
    });
</script>
@endsection
