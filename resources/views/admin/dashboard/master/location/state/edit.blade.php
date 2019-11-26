@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit State <a href="{{route('state.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('state.update', ['id' => $state->state_code])}}" method="post" >
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6">
									<label for="country_code">Select Country Name <span class="text-danger">*</span></label>
									<select class="form-control" name="country_code" id="country">
										<option value="0">Select Country Name</option>
										@foreach($countries as $country)
											<option value="{{$country->country_code}}" {{$state->country_code == $country->country_code ? 'selected' : ''}} {{old('country_code') == $country->country_code ? 'selected' : ''}}>{{$country->country_name}}</option>
										@endforeach
									</select>
									@error('country_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6">
									<label for="state_name">Enter State Name <span class="text-danger">*</span></label>
									<input type="text" name="state_name" class="form-control " value="{{old('state_name') ?? $state->state_name}}">
									@error('state_name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 text-center">
									<input type="submit"  value="Submit" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(document).ready(function(){
			$("select[name='country_code']").select2();
		});
	</script>
@endsection