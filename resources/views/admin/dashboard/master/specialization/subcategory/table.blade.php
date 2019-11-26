<table class="table table-striped table-bordered" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>Specialization Subcategory Name</th>
			<th>Specialization Subcategory Short Name</th>
			<th>Specialization Category Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@php  $count =0 ; @endphp
		@foreach($subcategories as $subcategory)								
			<tr>
				<td>{{++$count}}</td>
				 <td>{{$subcategory->subcatg_desc}}</td>
				 <td>{{$subcategory->short_desc}}</td>
				 <td>{{$subcategory->catg_desc}}</td>
				 <td>
				 	<form action="{{route('spec_subcategory.destroy', ['id' =>  $subcategory->subcatg_code ])}}" method="POST" id="delform_{{ $subcategory->subcatg_code }}">
					@method('DELETE')

				 	<a href="{{route('spec_subcategory.edit',['id'=>$subcategory->subcatg_code])}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>
				 
				 	<a href="javascript:$('#delform_{{ $subcategory->subcatg_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

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