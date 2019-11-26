@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Add Document <a href="{{route('qual_doc_mast.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('qual_doc_mast.store')}}" method="post" >
						@csrf 
							<div class="row form-group">							
								<div class="col-md-6">
									<label>Qualification Category</label>
									<select name="qual_catg_code" class="form-control">
										<option value="">Select Qualification Category</option>
										@foreach($qual_categories as $qual_category)
											<option value="{{$qual_category->qual_catg_code}}">{{$qual_category->qual_catg_desc}}</option>
										@endforeach
									</select>
									@error('qual_catg_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
					            </div>
					            <div class="col-md-6">
									<label>Docuemnt Type</label>
									<select name="qual_doc_type_id[]" class="form-control select2" multiple="multiple">
										<option value="" disabled>Select Document Type</option>	
										@foreach($doc_types as $doc_type)
											<option value="{{$doc_type->id}}">{{$doc_type->name}}</option>
										@endforeach									
									</select>
									@error('qual_doc_type_id')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
					            </div>
							</div>		
						
							
							<div class="row ">
								<div class="col-md-12 ">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
<script >
	$(document).ready(function(){
		$('.select2').select2();
	})
</script>
@endsection
