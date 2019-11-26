@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header" >
				<h3 style="margin-top: 10px;">Add Case Notes 					
					<a href="{{route('case_mast.show', $case_detail->case_id.','.$page_name)}}" class="btn btn-md btn-info pull-right">Back</a>
				</h3>
			</div>
			<div class="box-body">
				<form action="{{route('case_notes.store')}}" method="post">
					@csrf
					<div class="row form-group ">
						<div class="col-md-6 col-xs-6 col-sm-6" style="margin-top:10px;">
							<label for="case_note_heading">Case Notes Heading <span class="text-danger">*</span></label>
							<input type="text" name="case_note_heading" class="form-control" placeholder="Enter Note Heading" value="{{ old('case_note_heading')}}" >
							@error('case_note_heading')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6 col-xs-6 col-sm-6" style="margin-top:10px;">
							<label for="case_notes_type">Case Notes Type <span class="text-danger">*</span></label>
							<select class="form-control" name="case_notes_type">
								<option value="0">Select Case Notes Type</option>
								<option value="p" {{old('case_notes_type')== 'p' ? 'selected' : ''}}>Personal</option>
								<option value="c" {{old('case_notes_type')=='c' ? 'selected' : ''}}>Customer</option>
							</select>
							@error('case_notes_type')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12" style="margin-top:10px;">
							<label for="case_notes"> Case Notes <span class="text-danger">*</span></label>
							<textarea name="case_notes" rows="4" cols="50" class="form-control " placeholder="Case notes..."  id="summernote">{{old('case_notes')}}</textarea>

							@error('case_notes')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12" style="margin-top:10px;">
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