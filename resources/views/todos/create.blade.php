@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4 class="">Create To-dos
						<a href="{{route('todos.index')}}" class="btn bnt-sm btn-info pull-right">Back</a>
					</h4>
				</div>
				<div class="box-body">
					<form action="{{route('todos.store')}}" method="POST">
						<div class="row form-group">
							<div class="col-md-12">
								<label for="title">Title <span class="text-danger font-weight-bold">*</span></label></label>
								<input type="text" name="title" class="form-control" required>
								@error('title')
									<span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="description">Description <span class="text-danger font-weight-bold">*</span></label></label>
								<textarea type="text" name="description" class="form-control" rows="5" required=""></textarea> 
								@error('description')
									<span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>
						</div>
						{{-- <div class="row form-group">
							<div class="col-md-12">	
								<input type="checkbox" name="privacy" checked="" value="0" class="hidden">				
								<input type="checkbox" name="privacy" value="1"> <label for="privacy">Mark as Private</label>
							</div>
						</div> --}}
						<div class="row form-group">
							<div class="col-md-6">
								<label for="start_date">Start Date <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" name="start_date" class="form-control start_date" date-format="yyyy-mm-dd" value="{{date('Y-m-d')}}">
							</div>
							<div class="col-md-6">
								<label for="end_date">End Date <span class="text-danger font-weight-bold">*</span></label></label>
								<input type="text" name="end_date" class="form-control end_date"  date-format="yyyy-mm-dd" value="{{date('Y-m-d')}}">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="case_id1">Relate To</label>
								<select name="case_id1" class="form-control" id="caseTodo">
									<option value="0">Select Case</option>
									@foreach($cases as $case)
										<option value="{{$case->case_id}}" {{old('case_id1') ==$case->case_id ? 'selected' : '' }}>{{$case->case_title}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label for="users_id">Assign To Team Members</label>
								<select name="users_id[]" class="form-control select2 members_todo" multiple="multiple"  style="width: 100%" required>	
									
								</select>							
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
							
								<input type="hidden" name="page_name" value="todo">
								<button type="submit" class="btn btn-sm btn-success">Submit</button>
							</div>
						</div>
						@csrf
					</form>
				</div>
			</div>
		</div>		
	</div>	
</section>
<script>
	$(document).ready(function(){
		$('.select2').select2({
	tags: true,
	placeholder: 'Select an option',
	templateSelection : function (tag, container){
		
		var $option = $('.select2 option[value="'+tag.id+'"]');
	if ($option.attr('locked')){
	   $(container).addClass('locked-tag');
	   tag.locked = true; 
	}
		return tag.text;
	},
})
.on('select2:unselecting', function(e){
	
   if ($(e.params.args.data.element).attr('locked')) {
       e.preventDefault();
    }
 });
		$(".start_date,.end_date").datepicker({
			startDate : new Date(),
			format : 'yyyy-mm-dd',
			todayHighlight : true,
			setDate : new Date(),
			autoclose :true,
		});
		var auth_id = "{{Auth::user()->id}}";
		var auth_name = "{{Auth::user()->name}}";
		var case_id1="{{old('case_id1') != '' ? old('case_id1') : '0' }}";
		case_members(case_id1,auth_id,auth_name);

		$('#caseTodo').on('change',function(e){
			e.preventDefault();
			var case_id1 = $(this).val();
			case_members(case_id1,auth_id,auth_name);
		});

	});
</script>
@endsection