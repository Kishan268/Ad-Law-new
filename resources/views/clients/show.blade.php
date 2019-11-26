@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-6 col-xs-5 col-sm-6">
							<h3 style="margin-top: 8px;">Client Details</h3>
						</div>				
						<div class="col-md-6 col-xs-7 col-sm-6 text-right">
							
										
							<a href="{{route('clients.index')}}" class="btn btn-sm btn-info ">Back</a> 

						</div>	
					</div>			
				</div>
				<div class="box-body">
					@if($message = Session::get('success'))
						<div class="alert bg-success">
							{{$message}}
						</div>
					@endif
					<div class="row">
						<div class=" col-md-6 col-sm-6">
							<h4><b>Name :</b> {{ $client->cust_name }}</h4>
							@if($client->cust_type_id == '1')<h4><b>Gender :</b>
									@if($client->gender=='m')
										{{'Male'}}
									@elseif($client->gender=='f')
										{{'Female'}}
									@elseif($client->gender=='t')
										{{'Other'}}									
									@endif
							</h4>
							<h4><b>Date of birth :</b> <?php echo date('d-m-Y', strtotime($client->dob)); ?></h4>
							@else
								<h4><b>Company Name:</b> {{$client->company_name}}</h4>
							@endif
							<h4><b>Mobile Number :</b>								
									<span>{{$client->mobile1}}</span>
									<span>{{$client->mobile2}}</span>
							</h4>
							<h4><b>Email :</b> {{$client->email}}</h4>
							<h4><b>Registration Date :</b> {{ date('d-m-Y', strtotime($client->regsdate))}}</h4>
							
						</div>
						<div class="col-md-6 col-sm-6">
						
							<h4><b>Tele Number :</b> {{ $client->tele }}</h4>
							<h4><b>PAN Number :</b> {{ $client->panno }}</h4>
							<h4><b>GST Number :</b> {{ $client->gstno }}</h4>
							<h4><b>Aadhar Number :</b> {{ $client->adharno }}</h4>
							<h4><b>Adddress :</b> {{ $client->custaddr }}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12 mt-2">
			   <div class="box box-primary " >
        <div class="box-header with-border"> 	
          <div class="row">
            <div class="col-md-4">
               <h4 id="case_status_label"></h4>
            </div>
            <div class="col-md-6">
              <div class="row ">
                <div class="col-md-4 pull-right form-group">
                  <select class="form-control" name="case_status">
                   @foreach($case_status as $case_statu)
                      <option value="{{$case_statu->case_status_id}}" {{$case_statu->case_status_id == 'cr' ? 'selected' : ''}}>{{$case_statu->case_status_desc}}</option>
                   @endforeach 
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <a href="{{route('case_mast.create', ['cust_id'=>$client->cust_id.',clients'])}}" class="btn btn-sm btn-primary ">Add New Case</a> 
            </div>
          </div> 
            
            @if($message = Session::get('success'))
              <div class="alert bg-success">
                  {{$message}}
              </div>
            @endif   
        </div>
        <div class="box-body table-responsive" id="table_div">
   			
        </div>
        </div>
      </div>
    </div>
	
</section>
<script>
	$(document).ready(function(){
		$('#caseTable').DataTable();
		var case_status =  $('select[name="case_status"] option:selected').val();
		var case_status_text =  $('select[name="case_status"] option:selected').text();

		if(case_status !=''){
			var cust_id = "{{$client->cust_id}}";
			case_table(case_status,case_status_text,cust_id);
			$('select[name="case_status"]').on('change',function(){
				var case_status = $(this).val();
				var case_status_text = $('select[name="case_status"] option:selected').text();
				case_table(case_status,case_status_text,cust_id);
			});
		}
	});
</script>

@endsection
