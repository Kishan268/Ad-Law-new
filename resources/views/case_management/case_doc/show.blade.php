<div class="row">
	<div class="col-md-12">
		<a href="{{route('case_doc.create',['case_id'=>$case_id.','.$page_name])}}" class="btn btn-md btn-primary pull-right">Add Document</a>
		
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 table-responsive">
		<br>
		<table class="table table-striped table-bordered myTable">
			<thead>
				<tr>
					<th>SNo</th>								
					<th>Document Name</th>						
					<th>Document Remark</th>
					<th>Document Type</th>
					<th>Action</th>		
				</tr>														
			</thead>
			<tbody>
				@php $count = 0; @endphp
				@foreach($case_docs as $case_doc)
				<tr>
					<td>{{++$count}}</td>
					<td><?php echo explode('_',$case_doc->doc_name,2)[1]; ?></td>
					<td>{{$case_doc->doc_remark}}</td>
					<td>
						@if($case_doc->doc_type=='P')
							{{'Personal Ref'}}
						@elseif($case_doc->doc_type == 'C')
							{{'Court Related'}}
						@elseif($case_doc->doc_type=='D')
							{{'Case Ref'}}
						@endif
						</td>
					<td >					
					<form action="{{route('case_doc.destroy',['doc_id'=>$case_doc->doc_id])}}" method="POST" id="delform_{{$case_doc->doc_id}}">
						@method('DELETE')
							<a href="{{asset($case_doc->doc_url)}}" ><i class="btn btn-sm text-success fa fa-eye"></i>
							</a>
							<a href="{{route('fileDownload',['doc_id' =>$case_doc->doc_id])}}"><i class="btn btn-sm text-info fa fa-download"></i></a>

							<a href="javascript:$('#delform_{{$case_doc->doc_id}}').submit();" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash btn btn-sm text-danger" ></i></a>
						@csrf
					</form>
		
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