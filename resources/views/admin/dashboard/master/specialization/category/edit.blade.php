@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Specialization Category <a href="{{route('spec_category.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('spec_category.update',['id'=>$category->catg_code])}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6"> 
									<label for="catg_desc">Category Name <span class="text-danger">*</span></label>
									<input type="text" name="catg_desc" class="form-control" placeholder="Enter Category Name" value="{{old('catg_desc') ?? $category->catg_desc}}">
									@error('catg_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6"> 
									<label for="short_desc">Category Short Name</label>
									<input type="text" name="short_desc" class="form-control"  placeholder="Enter Category Short Name" value="{{old('short_desc') ?? $category->short_desc}}">
									@error('short_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">									
									<input type="submit"  value="Submit" class="btn btn-sm btn-primary">
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
		$(function () {
                $('.timepicker').datetimepicker({
                format: 'LT'
            });
        });
    });
</script>
@endsection