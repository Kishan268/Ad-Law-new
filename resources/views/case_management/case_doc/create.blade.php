@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Add Case Document 
					<a href="{{route('case_mast.show', $case_detail->case_id.','.$page_name)}}" class="btn btn-md btn-info pull-right">Back</a>	
				</h3>
			</div>
			<div class="box-body">
				<form action="{{route('case_doc.store')}}" method="post" enctype="multipart/form-data">
				@csrf
					<div class="row form-group ">
						<div class="col-md-6 col-xs-6 col-sm-6" style="margin-top: 10px;">
							<label for="doc_type">Document Type <span class="text-danger">*</span></label>
							<select class="form-control" name="doc_type">
								<option value="0">Select Document Type</option>
								 @foreach($doc_types  as $doc_type)	
									<option value="{{ $doc_type->doc_type_id }}" {{old('doc_type')==$doc_type->doc_type_id ? 'selected' : ''}}>{{ $doc_type->doc_type_desc }}</option>
								@endforeach
								
							</select>
							@error('doc_type')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6 col-xs-6 col-sm-6" style="margin-top: 10px;">
							<label class="doc_name">Document Attach <span class="text-danger">*</span></label>

							<input type="file" name="doc_name" class="form-control" >
							@error('doc_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12" style="margin-top: 10px;">
							<label for="doc_remark">Document Remark <span class="text-danger">*</span></label>

							<textarea name="doc_remark" rows="4" cols="50" class="form-control " placeholder="Document Remark....">{{old('doc_remark')}}</textarea>

							@error('doc_remark')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							<input type="hidden" name="cust_id" value="{{ $case_detail->cust_id }}">
							<input type="hidden" name="case_id" value="{{$case_detail->case_id}}" >
							<input type="hidden" name="page_name" value="{{$page_name}}">
							<button type="submit" class="btn btn-primary btn-md">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</section>
@endsection