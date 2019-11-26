@extends('lawfirm.layouts.main')
@section('content')
<section class="content">

<div class="row">
	<div class="col-md-12 ">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Edit Case Hearing 
					<a href="{{route('case_mast.show', $case_hearing->case_id.','.$page_name)}}" class="btn btn-md btn-info pull-right">Back</a>		
				</h3> 
			</div>
			<div class="box-body">
				<form action="{{route('case_hearing.update',$case_hearing->case_tran_id)}}" method="post">
				@csrf
				@method('PATCH')
					<div class="row form-group ">
						<div class="col-md-6">
							<label for="hearing_date">Hearing Date <span class="text-danger" >*</span></label>
							<input type="text" value="{{old('hearing_date') ?? $case_hearing->hearing_date}}" class="form-control " name="hearing_date" required autocomplete="case_reg_date" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d') }}" readonly>
							@error('hearing_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6">
							<label for="start_time">Start Time <span class="text-danger" >*</span></label>
							<input type='text' class="form-control" name= "start_time" id='datetimepicker3' value="{{$case_hearing->start_time }}" />
							@error('start_time')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					{{-- <div class="row form-group">
						<div class="col-md-6">
							<label>Case Charge Type <span class="text-dagner">*</span></label>
							<select name='case_charges_type' class="form-control">
								<option value="0">select</option>
								<option value="1" {{ old('case_charges_type') == '1' ? 'selected' : ''}} >Cash</option>
								<option value="2" {{ old('case_charges_type') == '2' ? 'selected' : ''}}>Chaque</option>
							</select>
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_charged">Case Charged</label>
							<input type="text" name="case_charged" class="form-control" placeholder="Enter Cash Charges Name" value="{{ old('case_charged')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
							@error('case_charged')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>		
					</div> --}}
				
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;" >
							<label for="lawyer_names">Lawyer Names <span class="text-danger" >*</span></label><span class="text-muted"> (Who attend)</span>
							<select name="lawyer_names[]" class="form-control select2" multiple="multiple" >
								@foreach($assign_mem as $assign_m)
									<option value="{{$assign_m->user_id1}}"
									@if(count(collect(old('lawyer_names'))) == '0') 
										@foreach($lawyer_ids as $lawyer_id)
											{{$lawyer_id == $assign_m->user_id1 ? 'selected' : ''}}  {{$lawyer_id == $assign_m->user_id1 ? 'locked="locked' : ''}} 
										@endforeach
									@else
									{{ (collect(old('lawyer_names'))->contains($assign_m->user_id1)) ? 'selected': '' }}
									@endif
									>{{$assign_m->member->name}}</option>
								@endforeach
							</select>
							
							@error('lawyer_names')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px;" >
							<label for="judges_name">Judge Names <span class="text-danger" >*</span></label>
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
							<label for="hearing_notes">Hearing Description <span class="text-danger">*</span></label>
							<textarea name="hearing_notes" rows="3" cols="50" class="form-control" id="tinymce">{{old('hearing_notes') ?? $case_hearing->hearing_notes}}</textarea>
							@error('hearing_notes')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12" style="margin-top: 10px;">
							<input type="hidden" name="case_id" value="{{ $case_hearing->case_id }}">
							<input type="hidden" name="cust_id" value="{{ $case_hearing->cust_id }}">
							<input type="hidden" name="user_id" value="{{Auth::user()->id }}">
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
<script>
	$(document).ready(function(){

	tinymce.init({
		selector: 'textarea#tinymce',
		menubar: false,
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor ",
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
	$(function () {
		$("#datepicker, #regdatepicker").datepicker({ 
			singleDatePicker: true,
			showDropdowns: true,
		});
	});

	
  var judges_name = "{{ count(collect(old('judges_name'))) !='0' ? count(collect(old('judges_name'))) : count($judges_name) }}";

 if(judges_name != '0' ){
 	var j=0;
 	@php 
 		$i =0;
 		$old_jug_names = count(collect(old('judges_name')));
 		if($old_jug_names !='0'){
 			$count =$old_jug_names ;
 		}
 		else{
 			$count = count($judges_name);
 		}

 	@endphp
	$('#dynamic_field2').append('<tr id="row'+j+'"><td style="padding:8px"><input type="text" name="judges_name[]" value="{{old('judges_name.'.$i) ?? $judges_name[$i]}}" placeholder="Enter Judge Name" class="form-control name_list" required /></td></tr>');
	j++;
	@php 
 		$i++;


 	@endphp

 	 <?php while($i < $count) {  ?>
 	// for(j =j ; j < judges_name ; j++){
 		$('#dynamic_field2').append('<tr id="row'+"{{$i}}"+'"><td style="padding:8px"><input type="text" name="judges_name[]" placeholder="Enter Judge Name" value="{{old('judges_name.'.$i) ?? $judges_name[$i] }}" class="form-control name_list" required /></td><td style="padding:8px"><button type="button" name="remove" id="'+"{{$i}}"+'" class="btn btn-sm btn-danger btn_remove"><i class="fa fa-close"></i></button></td></tr>');
	 	@php 
	 		$i++;
	 	@endphp
 	// }
 	<?php  } ?>
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
	
	
	$(function(){
	    $('#datetimepicker3').datetimepicker({
	        format: 'HH:mm:ss',
	        

	    });
	});

	
});
</script>


@endsection