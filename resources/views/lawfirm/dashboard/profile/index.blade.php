@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-sm-12">
		<div class="box box-primary" >
			<div class="box-header with-border" >
				<h3 class="" style="margin-top: 10px;">Profile <a href="{{route('lawfirm.edit', $user->id)}}" class="btn btn-sm btn-info pull-right">Edit Profile</a>
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
						@if($user->photo)
							<img src="{{ asset('storage/profile_photo/'.$user->photo)}}" class="img-circle" style="width: 200px; height: 175px;" >
						@else
							<img src="{{ asset('storage/profile_photo/default.png') }}" class="img-circle " style="width: 200px; height: 175px;" >
						@endif
					</div>
					<div class="col-md-8 col-sm-8 col-xl-8" style="margin-top: 20px">
						<h5><b>Full Name:</b> {{$user->name}}</h5>
						<h5><b>Email Address:</b> {{ $user->email }}</h5>
						<h5>
							@role('lawyer')
							<b>Date of Birth:</b>
							@endrole
							@role('lawcompany')
							<b>Registration Date:</b>
							@endrole

							 {{ date('d-m-Y', strtotime($user->dob)) }} </h5>
						<h5>@role('lawyer')
							<b>Gender:</b> @if($user->gender=='m')
										{{'Male'}}
									@elseif($user->gender =='f')
										{{ 'Female' }}
									@else
										{{ 'Other' }}
									@endif
							@endrole
						</h5>
						<h5><b>Mobile Number:</b> {{ $user->mobile}}</h5>
						@role('lawyer')
							<h5><b>Addhar Number:</b> {{ $user->aadhar_card }} </h5>
							<h5><b>PAN Number:</b> {{ strtoupper($user->pan_card) }} </h5>
						@endrole
							<h5><b>
							@role('lawyer')Bar Licence Number:@endrole
							@role('lawcompany')Registration Number:@endrole
						</b>{{$user->licence_no}}</h5>
						
						<h5><b>Address:</b> 
							@if($user->city['city_name']!=''|| $user->state['state_name'] !='' || $user->zip_code !=''  )
							{{$user->city['city_name'] . ', '. $user->state['state_name'] . ', '. $user->zip_code }}
							@else

							@endif
						</h5>

					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xl-12">
						<hr>
						<h5><b>Detail Profile:</b>  </h5>
						@php echo $user->detl_profile; @endphp	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection