@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Slots Time <a href="{{route('slots.create')}}" class="btn btn-sm btn-primary pull-right">Add Slots Time</a></h3>
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
									<th>Slot Time</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php  $count =0 ; @endphp
								@foreach($slots as $slot)								
									<tr>
										<td>{{++$count}}</td>
										 <td>{{ date('h:i A', strtotime($slot->slot)) }}</td>
										 <td>
										 	<form action="{{route('slots.destroy', ['id' =>  $slot->id ])}}" method="POST" id="delform_{{ $slot->id }}">
											@method('DELETE')

										 	<a href="{{route('slots.edit',$slot->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>


										 	<a href="javascript:$('#delform_{{ $slot->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

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