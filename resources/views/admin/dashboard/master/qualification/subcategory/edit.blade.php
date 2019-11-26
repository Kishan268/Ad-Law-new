@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Qualification Subcategory</h3>						
					</div>				
					<div class="box-body" id="subcategory" >					
						<form action="{{route('qual_subcategory.update',['id'=>$subcategory->qual_code])}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6">
									<label for="qual_catg_code">Qualification Category Name</label>
									<select class="form-control" name="qual_catg_code">
										<option value="0">Select Category<span class="text-danger">*</span></option>
										@foreach($quali as $qual)
											<option value="{{$qual->qual_catg_code}}" {{old('qual_catg_code') == $qual->qual_catg_code ? 'selected' : ''}} {{ $subcategory->qual_catg_code == $qual->qual_catg_code ? 'selected' : '' }}>{{$qual->qual_catg_desc}} </option>
										@endforeach 
									</select>
									@error('qual_catg_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>								
						
								<div class="col-md-6">
									<label for="qual_desc">Subcategory Name <span class="text-danger">*</span></label>
									<input type="text" name="qual_desc" class="form-control" placeholder="Enter Subcategory Name" value="{{old('qual_desc') ?? $subcategory->qual_desc}}">
									@error('qual_desc')
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
		$("select[name='qual_catg_code']").select2();		
    });
</script>
@endsection