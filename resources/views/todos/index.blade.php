@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class=""><b id="todoHeader">My To-dos List</b>
						@if(Auth::user()->parent_id == null )
							<a href="{{route('todos.create')}}" class="btn btn-sm btn-primary pull-right">Create To-dos</a>
						@endif
					</h4>
					<br>
				
					<div class="row">
						<div class="col-md-9">
							<span class="btn btn-md btn-primary btn-default " style="color:white"><b>All</b> (0
							) </span>
							<span class="btn btn-md btn-default"><b>Pending</b> (0)</span>
							{{-- <span class="btn btn-md btn-default"><b>Upcoming</b> (0)</span> --}}
							<span class="btn btn-md btn-default"><b>Completed</b> (0)</span>
						</div>
							@if(Auth::user()->parent_id == null )<div class="col-md-3 form-group">
								<select class="pull-right form-control" name="todoChange">
									{{-- <option>Everyone To-dos</option> --}}
									<option value="1" {{$todoCategory == '1' ? 'selected' : ''}}>My To-dos</option>
									<option value="0" {{$todoCategory == '0' ? 'selected' : ''}}>Member To-dos</option>	
								</select>
							
							</div>
							@endif
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							@if($message = Session::get('success'))
								<div class="alert bg-success">{{$message}}</div>
							@endif
						</div>
					</div>
				</div>
				<div class="box-body" id="todoTable">
					@include('todos.todo_table')
				</div>
			</div>
		</div>		
	</div>
	
</section>
<script type="text/javascript">
	$(document).ready(function(){
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
		$("select[name='todoChange']").on('change',function(){
			var todo = $(this).val();
			
			if(todo ==1){
				$('#todoHeader').text('My To-dos List');
			}
			else{
				$('#todoHeader').text('Member To-dos List');
			}
			$.ajax({
				type :'POST',
				url : "{{route('todos.tablechange')}}",
				data : {todo:todo},
				success:function(data){
					$('#todoTable').empty().html(data);
				}
			});
		});

		var todo = '1';
		if(todo ==1){
				$('#todoHeader').text('My To-dos List');
			}
			else{
				$('#todoHeader').text('Member To-dos List');
			}

	});
</script>
@endsection