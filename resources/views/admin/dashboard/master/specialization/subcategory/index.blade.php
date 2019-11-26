@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Specialization  SubCategory <a href="{{route('spec_subcategory.create')}}" class="btn btn-sm btn-primary pull-right">Add Subcategory</a></h3>
						<div class="row form-group">
							<div class="col-md-4">
								<label>Filter</label>
								<select name="catg_code" class="form-control">
									<option value="0">Select Specialization Category </option>
									@foreach($categories as $category)
										<option value="{{$category->catg_code}}">{{$category->catg_desc}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-1">
								<label></label>
								<button class="btn btn-sm btn-info form-control" id="btnFilter">Filter</button>
							</div>
						</div>
					</div>
					<div class="box-body " id="tableDiv">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						@include('admin.dashboard.master.specialization.subcategory.table')
					</div>
				</div>
			</div>
		</div>
	</section>
<script type="text/javascript">
	$(document).ready(function(){
	
		$('#myTable').DataTable();

		$('#btnFilter').on('click',function(e){
				e.preventDefault();
				var catg_code = $('select[name="catg_code"] option:selected').val();
				if(catg_code !=0){
					$.ajax({
						type:'post',
						url : '{{route('spec_subCategoryFilter')}}',
						data : {catg_code:catg_code},
						success:function(data){
							$('#tableDiv').empty().html(data);
						}
					});
				}
				else{
					alert('select state')
				}
			});
    });
</script>
@endsection