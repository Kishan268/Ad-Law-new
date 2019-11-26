@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">States <a href="{{route('state.create')}}" class="btn btn-sm btn-primary pull-right">Add State</a></h3>
						<br>
						<div class="row form-group">
							<div class="col-md-4">
								<label>Filter</label>
								<select name="country_code" class="form-control">
									<option value="0">Select Country </option>
									@foreach($countries as $country)
										<option value="{{$country->country_code}}" {{$country->country_code == '102' ? 'selected' : ''}}>{{$country->country_name}}</option>
									@endforeach 
								</select>
							</div>
							<div class="col-md-1">
								<label></label>
								<button class="btn btn-sm btn-info form-control" id="btnFilter">Filter</button>
							</div>
						</div>
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

						@include('admin.dashboard.master.location.state.table')
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#btnFilter').on('click',function(e){
				e.preventDefault();
				var country_code = $('select[name="country_code"] option:selected').val();

				if(country_code !=0){
					$.ajax({
						type:'post',
						url : '{{route('master.countryFilter')}}',
						data : {country_code:country_code},
						success:function(data){
						
							$('#tableDiv').empty().html(data);
						}
					});
				}
				else{
					alert('select state')
				}
			});

			var country_code = $('select[name="country_code"] option:selected').val();

				if(country_code !=0){
					$.ajax({
						type:'post',
						url : '{{route('master.countryFilter')}}',
						data : {country_code:country_code},
						success:function(data){
							
							$('#tableDiv').empty().html(data);
						}
					});
				}
				else{
					alert('select state')
				}
		});
	</script>
@endsection