@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-sm-12">  
		<div class="box box-primary" >
			<div class="box-header with-border" >
				<h3    style="margin-top: 10px;">Profile <a href="{{route('lawschools.edit', $user->id)}}" class="btn btn-sm btn-info pull-right">Edit Profile</a>
				</h3>
			</div>
			<div class="box-body">
				@if($message = Session::get('success'))
					<div style="margin-top: 10px;" class="alert bg-success">
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
						<p><b>Full Name:</b> {{$user->name}}</p>
						<p><b>Email Address:</b> {{ $user->email }}</p>
						<p><b>{{Auth::user()->user_catg_id == '4' ? 'Date of registration:' : 'Date of Birth:'}}</b> {{ $user->dob !=null ? date('d-m-Y', strtotime($user->dob)) : '' }} </p>
						@role(['teacher', 'student'])
						<h5><b>Gender:</b> @if($user->gender=='m')
										{{'Male'}}
									@elseif($user->gender =='f')
										{{ 'Female' }}
									@else
										{{ 'Other' }}
									@endif
						</h5>
						@endrole
						<p><b>Mobile Number:</b> {{ $user->mobile}}</p>
						{{-- <p><b>PAN Number:</b> {{ strtoupper($user->pan_card) }} </p> --}}
						<p><b>Address:</b> @if($user->city['city_name']!=''|| $user->state['state_name'] !='' || $user->zip_code !='')
							{{$user->city['city_name'] . ', '. $user->state['state_name'].', '. $user->zip_code }}
						@else

						@endif
						</p>
						@role('lawcollege')<p><b>Prospectus:</b>@if($user->doc_url !=null ){{$user->doc_url}} &nbsp;<a href="{{asset('storage/app/public/collage_document/'.$user->doc_url)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>@else {{'-'}} @endif</p>
						@endrole
					</div>
					
					
				</div>
				
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xl-12">
						<hr>
						<p><b>Detail Profile:</b> @php echo $user->detl_profile; @endphp</p>
					</div>
				</div>
				
			</div>

		</div>
	</div>
</div>
</section>
@endsection