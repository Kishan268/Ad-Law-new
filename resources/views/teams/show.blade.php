<h4>Teams ({{count($teams)}})				
<a href="{{route('teams.create')}}" class="btn btn-md btn-primary pull-right">Create Team</a></h4>
<div class="row">
	<div class="col-md-12">
		@if($message = Session::get('success'))
			<div class="alert bg-success">
				{{$message}}
			</div>
		@endif
	</div>
</div>
<div class="row" style="margin-top: 20px;">
	<div class="col-md-12 table-responsive">
		<table class="table table-bordered table-striped myTable"  >
			<thead>
				<tr>
					<th>#</th>
					<th>Team Name</th>
					<th>Members</th>
					<th>Created At</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@php $count = 0 ; @endphp
				@foreach($teams as $team)
				<tr>
					<td>{{++$count}}</td>
					<td>{{$team->name}}</td>
					<td>
						@foreach ($team->members as $val) 
                			{{$val->users->name . ','}} 
            			@endforeach
					</td>
					<td>{{date('d-m-Y', strtotime($team->created_at))}}</td>
					<td>
						<form action="{{route('teams.destroy',$team->id)}}" method="POST" id="delform_{{ $team->id}}">
							@method('DELETE')
						<a href="{{route('teams.edit', $team->id)}}" title="edit"><i class="fa fa-edit btn btn-sm text-green" style="font-size: 16px"></i></a>

						<a href="javascript:$('#delform_{{ $team->id}}').submit();"  onclick="return confirm('Are you sure want to delete team member permanetly?')" title="delete"><i class="fa fa-trash btn btn-sm text-red" style="font-size: 16px"></i></a>
						@csrf
					</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script >
	$(document).ready(function(){
		$('.myTable').DataTable();

	});
</script>