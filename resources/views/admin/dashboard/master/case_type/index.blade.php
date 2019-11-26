@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Case Types  <a href="{{route('case_type.create')}}" class="btn btn-sm btn-primary pull-right">Add Case Type</a></h3>
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
									<th>Case Type Name</th>
									<th>Court Name</th>
									<th>Court Type Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php  $count =0 ; @endphp
								@foreach($case_types as $case_type)								
									<tr>
										<td>{{++$count}}</td>
										 <td>{{$case_type->case_type_desc}}</td>
										 <td>{{$case_type->court_name}}</td>
										 <td>{{$case_type->court_type_name}}</td>
										 <td>
										 	<form action="{{route('case_type.destroy', ['id' =>  $case_type->case_type_id ])}}" method="POST" id="delform_{{ $case_type->case_type_id }}">
											@method('DELETE')

										 	<a href="{{route('case_type.edit',$case_type->case_type_id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="javascript:$('#delform_{{ $case_type->case_type_id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

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