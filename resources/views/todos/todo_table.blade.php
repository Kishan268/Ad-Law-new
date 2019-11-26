<table class="table table-striped table-bordered mytable">
	<thead>
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Description</th>
			<th>Start Date</th>								
			<th>End Date</th>								
			<th>Team Member</th>								
			<th>Status</th>								
		</tr>
	</thead>
	<tbody>
		@php $count = 0 ;@endphp
		@foreach($todos as $todo)
		<tr>
			<td>{{++$count}}</td>
			<td>{{  $todo->todos->title}}</td>
			<td>{{ $todo->todos->description}}</td>
			<td>{{ date('d-m-Y', strtotime($todo->todos->start_date))}}</td>
			<td>{{ date('d-m-Y', strtotime($todo->todos->end_date))}}</td>
			<td>
				
				@foreach($todo->todos->users as $users)
					<span>{{$users->user->name . ', '}}</span>
				@endforeach
			
			</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		$('.mytable').DataTable();
	});
</script>