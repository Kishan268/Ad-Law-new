<div class="row">
	<div class="col-md-12">	
		<h3 class="text-capitalize text-bold">{{$case->case_title}}</h3>
		<hr>
	</div>
	<div class="col-md-6">
		@if($case->c_d_flag == null)
			<h4><b>CNR Number:</b> {{$case->cnr_number}}</h4>
		@else
			<h4><b>@if($case->c_d_flag == 'c')Case @else Diary @endif Number:</b> {{$case->c_d_number }} of {{date('Y',strtotime($case->case_reg_date))}}</h4>
			@if($case->c_d_flag == 'c')
				<h4><b>Case Type Name:</b> {{$case->casetype->case_type_desc}}</h4>
			@endif
		@endif
		<h4><b>Case Category Name:</b> {{$case->catg_desc}}</h4>

		<h4><b>Case Subcategory Name:</b> {{$case->subcatg_desc}}</h4>
		<h4><b>Customer Name</b> {{$case->client->cust_name}}</h4>
		
	</div>
	<div class="col-md-6">
		<h4><b>Court Type:</b> {{$case->court_type_desc}}</h4>
		@if($case->court_code != null)<h4><b>Court Code:</b> {{$case->court_name}}</h4>@endif
		@if($case->state !=null)
			<h4><b>State Name:</b> {{$case->state->state_name}}</h4>
			<h4><b>City Name:</b> {{$case->city->city_name}}</h4>
		@endif
		
		<h4><b>Case Registration Date:</b> {{date('d-m-Y',strtotime($case->case_reg_date))}}</h4>
		@if($case->case_over_date !=null)
			<h4><b>Case Over Date:</b> {{date('d-m-Y',strtotime($case->case_over_date))}}</h4>
		@endif
		@if($case->appellant_name !=null)<h4><b>Appellant Name:</b> {{$case->appellant_name}}</h4>@endif
		@if($case->respondant_name !=null)<h4><b>Respondant Name:</b> {{$case->respondant_name}}</h4>@endif

		<h4><b>Case Fees:</b> {{$case->case_fees}}</h4>
		@if($case->affidavit_date !=null)
			<h4><b>Affidavit Date:</b> {{date('d-m-Y',strtotime($case->affidavit_date))}}</h4>
		@endif

	</div>

</div>
<hr>
<div class="row">		
	<div class="col-md-6">
		<h4><b>Allocate & Reallocate Members:</b></h4>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Allocate Member</th>
					<th>Allocate date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($case->members as $value)
					@if($value->deallocate_date == null )
						<tr>
							<td>{{$value->member->name}}</td>
							<td>{{date('d-m-Y',strtotime($value->allocate_date))}}</td>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>		
	</div>
	<div class="col-md-6">
		<h4><b>Deallocate Members:</b></h4>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Deallocate Member</th>
					<th>Allocate Date</th>
					<th>Deallocate Date</th>
				</tr>
				</thead>
			<tbody>
				@foreach($case->members as $value)
					@if($value->deallocate_date != null )
						<tr>
							<td>{{$value->member->name}}</td>
							<td>{{date('d-m-Y',strtotime($value->allocate_date))}}</td>
							<td>{{date('d-m-Y',strtotime($value->deallocate_date))}}</td>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>	
</div>

<div class="row">
	<div class="col-md-12">
	<hr>						
		<h4><b>Case Description:</b></h4>
	<p style="font-size: 20px;">@php echo $case->case_description @endphp</p>
</div>					
