<form action="{{route('todos.store')}}" method="POST">
	<div class="row form-group">
		<div class="col-md-12">
			<label for="title">Title <span class="text-danger font-weight-bold">*</span></label>
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
			<label for="description">Description <span class="text-danger font-weight-bold">*</span></label>
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
			<label for="end_date">End Date <span class="text-danger font-weight-bold">*</span></label>
			<input type="text" name="end_date" class="form-control end_date"  date-format="yyyy-mm-dd" value="{{date('Y-m-d')}}">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-6">
			<label for="case_id">Relate To</label>
			<select name="case_id" class="form-control">
				<option value="null">Select Case</option>
				@foreach($cases as $case)
					<option value="{{$case->case_id}}">{{$case->case_title}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-6">
			<label for="team_id">Assign To Team Members</label>
			<select name="team_id[]" class="form-control" id="select2" multiple="multiple" required>	
				{{-- <option value="{{Auth::user()->id}}" selected="" disabled="true">{{Auth::user()->name}}</option>
				@foreach($members as $member)
					<option value="{{$member->id}}">{{$member->name}}</option>
				@endforeach --}}
			</select>							
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-12">
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<button type="submit" class="btn btn-sm btn-success">Submit</button>
		</div>
	</div>
	@csrf
</form>
<script>
	$(document).ready(function(){
		$('#select2').select2();
		$(".start_date,.end_date").datepicker({
			startDate : new Date(),
			format : 'yyyy-mm-dd',
			todayHighlight : true,
			setDate : new Date(),
			autoclose :true,
		});

		

	});
</script>