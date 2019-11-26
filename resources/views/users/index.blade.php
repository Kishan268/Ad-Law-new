@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Users <a href="{{route('users.create')}}" class="btn btn-sm btn-primary pull-right">Add User</a></h3>
					</div>
					<div class="box-body table-responsive">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>User Name</th>
									<th>Email Address</th>
									<th>Mobile Number</th>
									<th>User Type</th>
									<th>Registration Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($users as $user)
									<tr>
										<td>{{++$count}}</td>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->mobile}} {{$user->mobile_no1 == '' ? '' : '|'}} {{$user->mobile_no1}}</td>
										<td>{{$user->role != null ? $user->role['display_name']  : '-'}}</td>
										<td>{{date('d-m-y', strtotime($user->created_at))}}</td>
										 <td>
										 	<form action="{{route('users.destroy', ['id' =>  $user->id ])}}" method="POST" id="delform_{{ $user->id }}">
											@method('DELETE')

										 	<a href="{{route('users.edit',$user->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="javascript:$('#delform_{{ $user->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

										 	@csrf
											</form>

										 </td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
	$(document).ready(function(){		
		$('#myTable').DataTable();
    });
</script>
@endsection