@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row"> 
	<div class="col-sm-12"> 
		<div class="box box-primary" >
			<div class="box-header with-border" >
				<h3 class="" style="margin-top: 10px;">Welcome to {{$lawcomp->name}}
				</h3>
			</div>
	 			
			<div class="box-body ">
			
				@if($message = Session::get('success'))
					<div style="" class="alert bg-success">
					{{$message}}
					</div>
				@endif
		
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xl-4 text-center " style="margin-top: 20px">

						@if($lawcomp->photo)
						<img src="{{ asset('storage/app/public/profile_photo/'.$lawcomp->photo)}}" class="img-circle" style="width: 200px; height: 175px;" >
						@else
							<img src="{{ asset('storage/app/public/profile_photo/default.png') }}" class="img-circle " style="width: 200px; height: 175px;" >
						@endif
					</div>
					<div class="col-md-8 col-sm-8 col-xl-8" style="margin-top: 20px">
						<p><b>Full Name:</b> {{$lawcomp->name}}</p>
						<p><b>Email Address:</b> {{ $lawcomp->email }}</p>
						<p><b>Date of registration:</b> {{ date('d-m-Y', strtotime($lawcomp->dob)) }} </p>
						<p><b>Mobile Number:</b> {{ $lawcomp->mobile}}</p>
						{{-- <p><b>PAN Number:</b> {{ strtoupper($lawcomp->pan_card) }} </p> --}}
						<p><b>Address:</b> @if($lawcomp->city['city_name']!=''|| $lawcomp->state['state_name'] !='' || $lawcomp->zip_code !='')
							{{$lawcomp->city['city_name'] . ', '. $lawcomp->state['state_name'].', '. $lawcomp->zip_code }}
						@else

						@endif
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xl-12">
						<hr>
						<p><b>Detail Profile:</b> @php echo $lawcomp->detl_profile; @endphp</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection