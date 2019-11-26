@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Specialization Subcategory <a href="{{route('spec_subcategory.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body" id="subcategory">
						<form action="{{route('spec_subcategory.update',['id'=>$subcategory->subcatg_code])}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6">
									<label for="catg_code">Category Name <span class="text-danger">*</span></label>
									<select class="form-control" name="catg_code">
										<option value="0">Select Specialization Category</option>
										@foreach($categories as $category)
											<option value="{{$category->catg_code}}" {{$subcategory->catg_code == $category->catg_code ? 'selected' : ''}} {{old('catg_code') == $category->catg_code ? 'selected' : ''}}>{{$category->catg_desc}}</option>
										@endforeach
									</select>
									@error('catg_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>								
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="subcatg_desc">Subcategory Name <span class="text-danger">*</span> </label>
									<input type="text" name="subcatg_desc" class="form-control" placeholder="Enter Subcategory Name" value="{{old('subcatg_desc') ?? $subcategory->subcatg_desc}}">
									@error('subcatg_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>

								<div class="col-md-6">
									<label for="short_desc">Subcategory Short Name </label>
									<input type="text" name="short_desc" class="form-control" placeholder="Enter Subcategory Short Name" value="{{old('short_desc') ?? $subcategory->short_desc}}">
									@error('short_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
<script type="text/javascript">
	$(document).ready(function(){
		$("select[name='catg_code']").select2();		
    });
</script>
@endsection