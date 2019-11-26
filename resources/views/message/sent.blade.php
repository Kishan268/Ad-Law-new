@extends('message.sidebar')
@section('inbox-body')
<div class="col-sm-9"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title" >Sent</h3>
		</div>
		<div class="box-body table-responsive">	
			<div class="row">
	    		<div class="col-md-12">
		    		<div class="mailbox-controls">
	                <!-- Check all button -->
	                <button class="btn btn-default btn-sm">
	                	<input type="checkbox" id="checkAll" >
	                </button>

	                <div class="btn-group">
	                	<button type="button" class="btn btn-default btn-sm" id="trashBtn" ><i class="fa fa-trash-o"></i></button>	                  
	                </div>
	                <!-- /.btn-group -->
	                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
	               
	                <!-- /.pull-right -->
	              </div>
	    		</div>
	    	</div>
	 
				<table class="table table-hover table-striped table-bordered"  id="messageTable">
					<thead>
						<tr class="text-muted">
							<th></th>
							<th>SNo.</th>
							<th>To</th>
							<th>Subject</th>
							<th>Message</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@php $count= 1;@endphp
						@if(count($messages)!=0)
						@foreach($messages as $message)
						
							<tr >
								<td><input type="checkbox" name="msg" value="{{$message->id}}"></td>
								<td><a  href="{{route('message.show',['id'=>$message->id])}}">{{$count++}}</a> </td>
								<td><a  href="{{route('message.show',['id'=>$message->id])}}">{{$message->name}}</a></td>
								<td><a  href="{{route('message.show',['id'=>$message->id])}}">{{$message->subject}}</a></td>
								<td><a  href="{{route('message.show',['id'=>$message->id])}}">{{mb_substr($message->message,0,20)}}</a></td>
								<td ><a  href="{{route('message.show',['id'=>$message->id])}}">{{ isset($message->created_at) ? $message->created_at->format('d M, Y') : '' }}</a> 
							<p class="pull-right text-muted">{{$message->created_at->format('H:i')}}</p></td>
							</tr>
							
						@endforeach
						@else
							<tr>
								<td class="text-center" colspan="6">No Messages</td>
							</tr>
						@endif
					</tbody>
				</table>			
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$.ajaxSetup({
		      headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		      }
   		});
		$('#messageTable').DataTable();
			$("#checkAll").click(function(){
		    $('input:checkbox').not(this).prop('checked', this.checked);
		});
		$("#trashBtn").on('click',function(e){
			e.preventDefault();
			var msgIds = [];
			$.each($("input[name='msg']:checked"),function() {
				msgIds.push($(this).val());
			});

			if(msgIds.length == 0){
				swal({
			          text: 'Select message',
			          icon: 'warning'
	   			});
			}
			else{				  
				swal({
					title: "Are you sure ??",
					text: "Are you sure you want to delete messages permanently", 
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
						type:'get',
						url: '{{route('message.delete')}}?msgIds='+msgIds,
						success:function(data){
						swal({
						    text : data,
						    icon : 'success',
						  });
						  setTimeout(function(){// wait for 5 secs(2)
						     location.reload(); // then reload the page.(3)
						  }, 2000); 
					}
				});
				} else {
					swal("Your messages is safe!");
					}					      
				});			
			}
		});
	});
</script>
@endsection