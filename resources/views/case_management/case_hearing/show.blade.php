<div class="row">
	<div class="col-md-12">			
		<a href="{{route('case_hearing.create', ['case_id'=>$case_id.','.$page_name])}}" class="btn btn-md btn-primary pull-right" >Add Hearing</a>	
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 table-responsive">
		<br>
	<table class="table table-striped table-bordered myTable">
		<thead>
			<tr>				
				<th>Hearing No.</th>								
				<th>Lawyer Name</th>
				<th>Judge Name</th>
				<th>Hearing Date</th>
				<th>Start Time</th>
				<th>Action</th>	
			</tr>														
		</thead>
		<tbody>
		
		@foreach($case_hearings as $case_hearing)
			<tr>
				<td>{{ $case_hearing->seq_no}}</td>					
				<td>
					@php 
						$law_data = json_decode($case_hearing->lawyer_names) ;
						foreach ($law_data as $value) {
						 	$user = \App\User::find($value);
						 	echo $user->name .', ';
						 } 

					@endphp
				</td>
				<td>
					@php 
						$law_data = json_decode($case_hearing->judges_name) ;
						foreach ($law_data as $value) {
						 	echo $value .', ';
						} 
					@endphp
				</td>
				<td>{{ $case_hearing->hearing_date}}</td>
				<td>{{ $case_hearing->start_time}}</td>
					
				<td class="d-flex">
					<form action="{{ route('case_hearing.destroy',['id'=>$case_hearing->case_tran_id])}}" method="POST" id="delform_{{ $case_hearing->case_tran_id}}">
						@method('DELETE')
							
						<a href="{{ route('case_hearing.edit', $case_hearing->case_tran_id.','.$page_name) }}" ><i class="btn text-success fa fa-edit"></i></a>					
					
						<a href="javascript:$('#delform_{{ $case_hearing->case_tran_id}}').submit();" onclick="return confirm('Are you sure?')" class=""><i class="btn btn-sm text-danger fa fa-trash"></i></a >

					@csrf				
					</form>
					</span>
				</td>	
			</tr>
		@endforeach							
		</tbody>
	</table>
	</div>
</div>
<script >
	$('.myTable').DataTable({
          searching:true,
          scrolling:true,
    });
</script>