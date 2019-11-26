@extends('message.sidebar')
@section('inbox-body')
	<div class="col-sm-9" > 
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Message</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-1 col-xs-3">
						@if($message->photo !='')
							<img src="{{asset('storage/app/public/profile_photo/'.$message->photo)}}" style="width: 60px; height: 60px; " alt='Sender Image'>
							@else
							<img src="{{asset('storage/app/public/profile_photo/default.png')}}"  style="width: 60px; height: 60px;"  />
						@endif
					</div>

					<div class="col-md-8 col-sm-8 col-xl-5">
						<h3 class="" style="margin-top: 7px;">{{$message->name}}</h3>
					</div>
					<div class="col-md-3 col-sm-3 col-xl-3">
						<p>	{{ $message->created_at->format('d M, Y h:i') }}</p>
					</div>
					
				</div>
				
				<div class="row">

					<div class="col-sm-12 " >
						<h3 class="text-capitalize" style="font-weight: 700">{{$message->subject}}</h3>
						<hr>
						<p class="text-justify">
							{{$message->message}}
						</p>
					</div>
				</div>
				 @if(Auth::user()->id == $message->sender_id )
				 @else
				<form action="{{route('message.reply')}}" method="post">
					@csrf
					<div class="row form-group">
						<div class="col-md-12 col-sm-12">
							<a id="reply-btn" class="btn btn-sm btn-default " style=" border:1px solid #7b7b7b ;" ><i class="fa fa-reply" ></i> Reply</a> 
						</div>
					</div>
					<div class="row form-group" id="reply-body" style="display:none; ">
				
						<div class="col-sm-12 col-md-12" >
							<textarea rows="5" cols="10" name="message" class="form-control" placeholder="Type reply Here..."></textarea>
							@error('message')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>	

						<div class="col-md-12" style="margin-top: 10px;">
							<input type="hidden" name="parent_id" value="{{$message->id}}">
							<input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
							<input type="hidden" name="recv_id" value="{{$message->sender_id}}">
							<input type="hidden" name="subject" value="{{$message->subject}}">
							<input type='hidden' name="status" value="0">
							
							<button class="btn btn-sm btn-info">Send</button>
						</div>
					</div>		
				
				</form>
				@endif
			</div>
		</div>
	</div>
</section>
@if($message = Session::get('success'))
	<script type="text/javascript">
	$(document).ready(function(){
		var msg =  "{{$message}}";
		alert(msg);
	});
	</script>	
@endif

@error('message')
<script >
	$(document).ready(function(){
		$('#reply-body').show();
	});
</script>
@enderror
<script >
	$(document).ready(function(){
		$('#reply-btn').on('click',function(){
			
			$('#reply-body').toggle();
		});
		var error = "{{old('message')}}";
		

	});

</script>
@endsection