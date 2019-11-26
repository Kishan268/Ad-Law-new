@extends('lawschools.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border text-center">
					<h4 class="box-title"><b>Welecome to {{$college_details->name}} Profile</b></h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xl-4 text-center " style="margin-top: 20px">
							@if($college_details->photo)
								<img src="{{ asset('storage/profile_photo/'.$college_details->photo)}}" class="img-circle" style="width: 200px; height: 175px;" >
							@else
								<img src="{{ asset('storage/profile_photo/default.png') }}" class="img-circle " style="width: 200px; height: 175px;" >
							@endif
						</div>
						
					<div class="col-md-8 col-sm-8 col-xl-8" style="margin-top: 20px">
							<p><b>Full Name:</b> {{$college_details->name}}</p>
							<p><b>Email Address:</b> {{ $college_details->email }}</p>
							<p><b>Date of registration:</b> {{ $college_details->dob !=null ? date('d-m-Y', strtotime($college_details->dob)) : '' }} </p>
							<p><b>Mobile Number:</b> {{ $college_details->mobile}}</p>
							{{-- <p><b>PAN Number:</b> {{ strtoupper($college_details->pan_card) }} </p> --}}
							<p><b>Address:</b> @if($college_details->city['city_name']!=''|| $college_details->state['state_name'] !='' || $college_details->zip_code !='')
								{{$college_details->city['city_name'] . ', '. $college_details->state['state_name'].', '. $college_details->zip_code }}
							@else

							@endif
							</p>
							<p><b>Prospectus:</b>@if($college_details->doc_url !=null ){{$college_details->doc_url}} &nbsp;<a href="{{asset('storage/app/public/collage_document/'.$college_details->doc_url)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>@else {{'-'}} @endif</p>

						</div>
						
						
					</div>
					
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xl-12">
							<hr>
							<p><b>Detail Profile:</b> @php echo $college_details->detl_profile; @endphp</p>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</section>
@endsection