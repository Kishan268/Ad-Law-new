<table class="table table-striped table-bordered" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>City Name</th>
			<th>State Name</th>
			<th>Country Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@php 
			$count=1;
		@endphp
		@foreach($cities as $city)
			<tr>
				<td>{{$count++}}</td>
				<td>{{$city->city_name}}</td>
				<td>{{$city->state->state_name}}</td>
				<td>{{$city->country->country_name}}</td>
				<td>
					<form action="{{route('city.destroy', ['id' =>  $city->city_code ])}}" method="POST" id="delform_{{ $city->city_code }}">
					@method('DELETE')

					<a href="{{route('city.edit',$city->city_code)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

					<a href="javascript:$('#delform_{{ $city->city_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
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
