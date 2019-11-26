@extends('lawschools.layouts.main')
@section('content')
<section class="content">
	<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Batch<a href="{{route('batches.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						@if($message = Session::get('warning'))
								<div style="margin-top: 10px;" class="alert bg-warning">
									{{$message}}
								</div>
							@endif
						<form id="example-form1" action="{{route('batches.store')}}" method="post">
			        	<div class="row form-group">			        		
			        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
			        			<label class="required">Start Date</label>
			        			<input type="text" id="start_date" name="start_date" class="form-control datepicker" placeholder="YYYY-mm-dd"  readonly value="{{old('start_date')}}">
			        			@error('start_date')
									<span class="text-danger">
										<strong>{{$message}}</strong>
									</span>
								@enderror
			        		</div>
			        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
			        			<label class="required">End Date</label>
			        			<input type="text" id="end_date" name="end_date" class="form-control datepicker" placeholder="YYYY-mm-dd" readonly value="{{old('end_date')}}">
			        			@error('end_date')
									<span class="text-danger">
										<strong>{{$message}}</strong>
									</span>
								@enderror
			        		</div>			        		
			        	</div>
			        	<div class="row form-group">
			        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
			        			<label class="required">Batch Name</label>
			        			<input readonly="true" type="text" name="name" class="form-control" placeholder="YYYY-YYYY" value="{{old('name')}}">			        			
			        			
			        		</div>
			        	</div>
			        	<div class="row form-group">
			        		<div class="col-md-12">
			        			 <button type="submit" class="btn btn-primary">Submit</button>
						 		 @csrf
			        		</div>
			           	</div>			        	
			        </form>
					</div>
				</div>
			</div>
		</div>
	</section>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker({
			format:'yyyy-mm-dd'
		});
		$('#myTable').DataTable();

		  $("#end_date").on('focusout keyup',function(){
            var startDate = new Date($('#start_date').val()).getFullYear();
            var endDate = new Date($(this).val()).getFullYear();
            if(endDate != ''){
            	$("input[name='name']").val(startDate+'-'+endDate)
        	}
           
        });
    });

	$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
    $('th.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
		var form = $("#example-form1");

		form.validate({   
		    rules: {
		    	start_date:{
		    		required:true,
		    		date:true
		    	},
		    	end_date:{
		    		greaterthan: true,
		    		required:true,
		    		date:true
		    	},
		    	
		    },

			errorElement: "em",
			errorPlacement: function errorPlacement(error, element) { 
				element.after(error);
				error.addClass( "help-block" );

			 },
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".error-div" ).addClass( "has-error" ).removeClass( "has-success" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".error-div" ).addClass( "has-success" ).removeClass( "has-error" );
			},
			submitHandler: function (form) {
		                    form.submit();
		                          }
		});
		$.validator.addMethod('greaterthan',function(value,element){
				var start_date =new Date($('#start_date').val());
				var end_date = new Date(value);
				console.log(start_date.getFullYear()+1);
				if(end_date.getFullYear() == start_date.getFullYear()+1 ){
					return true;
				}else{
					return false;
				}

			},"End date year should be greater than 1 year to start date year.");

	
</script>
@endsection