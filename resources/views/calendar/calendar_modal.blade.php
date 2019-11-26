<div id="calendar_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h3 class="modal-title text-center"><b>NEW CALENDAR ENTRY</b></h3>        		
			</div>
			<div class="modal-body">
				<div class="row">
        			<div class="col-md-12 text-center">
        				<h4> <b>Type:</b> &nbsp; <span> <input type="radio" name="divtype" value="1" checked> Hearing Date</span>
						<span> <input type="radio" name="divtype" value="0" > To-do</span> 

        				</h4>
        			</div> 
        		</div>
				<div class="row" id="hearingDiv">
					<div class="col-md-12">
						<form action="{{route('case_hearing.store')}}" method="post">
						@csrf
						<div class="row form-group">
							<div class="col-md-12">
								<label for="case_id">Belongs To: <span class="text-danger">*</span></label>
								<select class="form-control" name="case_id" id="case" >
									<option value="null">Select Case</option>
									@foreach($cases as $case)
										<option value="{{$case->case_id}}" {{old('case_id') == $case->case_id ? 'selected' : ''}}>{{$case->case_title}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="hearing_date">Hearing Date: <span class="text-danger">*</span></label>
								<input type="text" value="{{old('hearing_date')}}" class="form-control h_date" name="hearing_date" required >
								@error('hearing_date')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="start_time">Start Time: <span class="text-danger">*</span></label>
								<input type='text' class="form-control" name= "start_time" id='datetimepicker3' value="{{old('start_time')}}"  placeholder="{{date('G:i:s')}}"  />
								@error('start_time')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="lawyer_names">Lawyer Names: <span class="text-danger" >*</span></label><span class="text-muted"> (Who attend)</span>
							<select name="lawyer_names[]" class="form-control hearing_members select2" multiple="multiple " style="width: 100%" >
								
							</select>
							
							@error('lawyer_names')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="judges_name">Judge Names: <span class="text-danger" >*</span></label>
								<table id='dynamic_field2' class='table'>

								</table>

								<button type="button" name="add" id="add_again" class="btn btn-success btn-sm">Add More</button>
								
								@error('judges_name')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="hearing_notes">Hearing Description: <span class="text-danger">*</span></label>
								<textarea name="hearing_notes" rows="3" cols="50" class="form-control" id="tinymce">{{old('hearing_notes')}}</textarea>
								@error('hearing_notes')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12" style="margin-top: 10px;">
								<input type="hidden" name="user_id" value="{{Auth::user()->id }}">
								<input type="hidden" name="page_name" value="calendar">
								<button type="submit" class="btn btn-primary btn-md">Submit</button>
							</div>
						</div>
						</form>
					</div>
				</div>

				<div class="row " id="todoDiv" style="display: none">
					<div class="col-md-12">
					<form action="{{route('todos.store')}}" method="POST">
						<div class="row form-group">
							<div class="col-md-12">
								<label for="title">Title: <span class="text-danger font-weight-bold">*</span></label></label>
								<input type="text" name="title" class="form-control" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="description">Description: <span class="text-danger font-weight-bold">*</span></label></label>
								<textarea type="text" name="description" class="form-control" rows="5" required=""></textarea> 
							</div>
						</div>
					{{-- 	<div class="row form-group">
							<div class="col-md-12">	
								<input type="checkbox" name="privacy" checked="" value="0" class="hidden">				
								<input type="checkbox" name="privacy"> <label for="privacy">Mark as Private</label>
							</div>
						</div> --}}
						<div class="row form-group">
							<div class="col-md-6">
								<label for="start_date">Start Date: <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" name="start_date" class="form-control start_date" date-format="yyyy-mm-dd" value="">
							</div>
							<div class="col-md-6">
								<label for="end_date">End Date: <span class="text-danger font-weight-bold">*</span></label></label>
								<input type="text" name="end_date" class="form-control end_date"  date-format="yyyy-mm-dd" value="">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="case_id1">Relate To: </label>
								<select class="form-control" name="case_id1" id="caseTodo" >
									<option value="0">Select Case</option>
									@foreach($cases as $case)
										<option value="{{$case->case_id}}" {{old('case_id1') == $case->case_id ? 'selected' : ''}}>{{$case->case_title}}</option>
									@endforeach
								</select>
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="users_id">Assign To Team Members <span class="text-danger font-weight-bold">*</span></label>
								<br>
								<select name="users_id[]" class="form-control select2 members_todo" multiple="multiple"  style="width: 100%" required>	
									
								</select>							
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								
								<button type="submit" class="btn btn-sm btn-success">Submit</button>
							</div>
						</div>
						@csrf
					</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		
	</div>
</div>
<script >

$(document).ready(function(){
	$('input[name="divtype"]').on('change',function(){
		var type = $(this).val();
		if(type == '1'){
			$('#hearingDiv').show();
			$('#todoDiv').hide();
		}else{
			$('#todoDiv').show();
			$('#hearingDiv').hide();
		}

	});
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
	$(".start_date,.end_date,.h_date").datepicker({
		startDate : new Date(),
		format : 'yyyy-mm-dd',
		todayHighlight : true,
		setDate : new Date(),
		autoclose :true,
	});
	tinymce.init({
		selector: 'textarea#tinymce',
		menubar: false,
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor ",
	});
	var judges_name = "{{ count(collect(old('judges_name'))) }}";
	if(judges_name != '0' ){
		var j=0;
		@php 
			$i =0;
			$count = count(collect(old('judges_name')));
		@endphp
		$('#dynamic_field2').append('<tr id="row'+j+'"><td style="padding:8px"><input type="text" name="judges_name[]" value="{{old('judges_name.'.$i)}}" placeholder="Enter Judge Name" class="form-control name_list" required /></td></tr>');
		j++;
		@php 
			$i++;
 			while($i < $count) { 
 		@endphp	
			$('#dynamic_field2').append('<tr id="row'+"{{$i}}"+'"><td style="padding:8px"><input type="text" name="judges_name[]" placeholder="Enter Judge Name" value="{{old('judges_name.'.$i)}}" class="form-control name_list" required /></td><td style="padding:8px"><button type="button" name="remove" id="'+"{{$i}}"+'" class="btn btn-sm btn-danger btn_remove"><i class="fa fa-close"></i></button></td></tr>');
	 	@php 
	 		$i++;
	 	  }
	 	@endphp
		j = "{{$i}}" ;
	}
	else{
	var j=0;
		$('#dynamic_field2').append('<tr id="row'+j+'"><td style="padding:8px"><input type="text" name="judges_name[]" placeholder="Enter Judge Name" class="form-control name_list" required /></td></tr>');
		j++;
	}	
	$('#add_again').click(function(){
		$('#dynamic_field2').append('<tr id="row'+j+'"><td style="padding:8px"><input type="text" name="judges_name[]" placeholder="Enter Judge Name" class="form-control name_list" required /></td><td class="padding:8px"><button type="button" name="remove" id="'+j+'" class="btn btn-sm btn-danger btn_remove"><i class="fa fa-close"></i></button></td></tr>');

		j++;
	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		//alert(button_id); 
		$('#row'+button_id+'').remove();
	});
	var auth_id = "{{Auth::user()->id}}"; 
	var case_id = "{{old('case_id')}}";
	if(case_id != null){
		hearing_members(case_id,auth_id);		
	}

	$('#case').on('change',function(e){
		e.preventDefault();
		var case_id = $(this).val();
		hearing_members(case_id,auth_id);
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

	$('#datetimepicker3').datetimepicker({
	    format: 'HH:mm:ss',

	});
});
</script>