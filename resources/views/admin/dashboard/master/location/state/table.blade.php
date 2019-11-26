<table class="table table-striped table-bordered" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>State Name</th>
			<th>Country Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@php 
			$count=1;
		@endphp
		@foreach($states as $state)
			<tr>
				<td>{{$count++}}</td>				
				<td>{{$state->state_name}}</td>
				<td>{{$state->country->country_name}}</td>
				<td>
					<form action="{{route('state.destroy', ['id' =>  $state->state_code ])}}" method="POST" id="delform_{{ $state->state_code }}">
					@method('DELETE')

						<a href="{{route('state.edit',$state->state_code)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

					<a href="javascript:$('#delform_{{ $state->state_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

					@csrf
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<script >
	$(document).ready(function(){
		$('#myTable').DataTable();
	});

</script>
