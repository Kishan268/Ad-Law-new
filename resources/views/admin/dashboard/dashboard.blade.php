@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Messages</span>
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total User</span>
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		
	
		{{-- 	<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Billing Amount</span>						
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		 --}}
		
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Messages</span>
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>
		</div>	
		<div class="row">
	      <div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-money"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Billing Amount</span>						
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Current Month Billing Amount</span>						
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-money"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Current Month Account Expire</span>						
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		

	    </div>	
	</section>
@endsection