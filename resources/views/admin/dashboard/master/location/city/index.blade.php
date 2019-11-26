@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Cities <a href="{{route('city.create')}}" class="btn btn-sm btn-primary pull-right">Add City</a></h3>
						<br>
						<div class="row form-group">
							<div class="col-md-4">
								<label>Filter</label>
								<select name="state_code" class="form-control">
									<option value="0">Select State </option>
									@foreach($states as $state)
										<option value="{{$state->state_code}}">{{$state->state_name}}</option>
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

						@include('admin.dashboard.master.location.city.table')
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#btnFilter').on('click',function(e){
				e.preventDefault();
				var state_code = $('select[name="state_code"] option:selected').val();
				if(state_code !=0){
					$.ajax({
						type:'post',
						url : '{{route('master.cityfilter')}}',
						data : {state_code:state_code},
						success:function(data){
							$('#tableDiv').empty().html(data);
						}
					});
				}
				else{
					alert('select state')
				}
			});
		});
	</script>
@endsection