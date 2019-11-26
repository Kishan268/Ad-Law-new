@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Countries <a href="{{route('country.create')}}" class="btn btn-sm btn-primary pull-right">Add Country</a></h3>
						<br>
						
						<div class="row">
							<div class="col-md-12">
								@if($message = Session::get('success'))
									<div class="alert bg-success">
										{{$message}}
									</div>
								@endif
							</div>
						</div>
					</div>

					<div class="box-body" id="tableDiv">
						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Country Name</th>
									<th>Phone Code</th>
									<th>Short name (2 letter)</th>
									<th>Short name (3 letter)</th>
									<th>Nationality</th>
									<th>Currency Name</th>
									<th>Currency Short Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($countries as $country)
								<tr>
									<td>{{++$count}}</td>
									<td>{{$country->country_name}}</td>
									<td>{{$country->phone_code}}</td>
									<td>{{$country->iso2}}</td>
									<td>{{$country->iso3}}</td>
									<td>{{$country->nationality }}</td>
									<td>{{$country->currency_name }}</td>
									<td>{{$country->currency_code }}</td>
									<td>
										
										
										<form action="{{route('country.destroy', ['id' =>  $country->country_code ])}}" method="POST" id="delform_{{ $country->country_code }}">

										@method('DELETE')

										<a href="{{route('country.edit',$country->country_code)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										<a href="javascript:$('#delform_{{ $country->country_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
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