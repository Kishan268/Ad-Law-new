<table class="table table-striped table-bordered" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>Qualification Subcategory Name</th>	
			<th>Qualification Category Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@php  $count =0 ; @endphp
		@foreach($subcategories as $subcategory)								
			<tr>
				<td>{{++$count}}</td>
				 <td>{{$subcategory->qual_desc}}</td>
			
				 <td>{{$subcategory->qual_catg_desc}}</td>
				 <td>
				 	<form action="{{route('qual_subcategory.destroy', ['id' => $subcategory->qual_code])}}" method="POST" id="delform_{{ $subcategory->qual_code }}">
					@method('DELETE')

				 	<a href="{{route('qual_subcategory.edit',['id'=>$subcategory->qual_code])}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

				 	

				 	<a href="javascript:$('#delform_{{ $subcategory->qual_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

					@csrf
					</form>
				 </td>
			</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
	
		$('#myTable').DataTable();
	});
</script>