@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Qualification Category <a href="{{route('qual_category.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>						
					</div>
					<div class="box-body" id="category">
						
						<form action="{{route('qual_category.update',['id'=>$qual->qual_catg_code])}} " method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6"> 
									<label for="qual_catg_desc">Category Name <span class="text-danger">*</span></label>
									<input type="text" name="qual_catg_desc" class="form-control" placeholder="Enter Category Name" value="{{old('qual_catg_desc') ?? $qual->qual_catg_desc}}">
									@error('qual_catg_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror

								</div>
								<div class="col-md-6"> 
									<label for="shrt_desc">Category Short Name</label>
									<input type="text" name="shrt_desc" class="form-control"  placeholder="Enter Category Short Name" value="{{old('shrt_desc') ?? $qual->shrt_desc}}">
									@error('shrt_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">									
									<input type="submit" name="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection