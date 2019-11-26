@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Create Slots Time <a href="{{route('slots.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('slots.store')}}" method="post" >
						@csrf 
							<div class="row form-group">							
								<div class="col-md-6">
									<label for="slot">Enter Slot Time <span class="text-danger">*</span></label>
									  <div class="input-group">
					                    <input type="text" class="form-control timepicker" name="slot" required="" placeholder="Enter Slots Time">

					                    <div class="input-group-addon">
					                      <i class="fa fa-clock-o"></i>
					                    </div>
					                  </div>
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 ">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
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
			$(function () {
	                $('.timepicker').datetimepicker({
	                format: 'LT'
	            });
	        });
		
    	});
	</script>
@endsection
