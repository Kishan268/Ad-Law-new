@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary ">
			<div class="box-header with-border" >
					<button class="btn btn-md btn-primary" id="case_detl">Case Details</button>
					<button class="btn btn-md " id="hearing_detl">Case Hearings Details</button>
					<button class="btn btn-md " id="doc_detl">Case Documents Details</button>
					<button class="btn btn-md " id="note_detl">Case Notes Details</button>
					@if($page_name == 'clients')
						<a href="{{route('clients.show',$case->cust_id)}}" class="btn btn-md btn-info pull-right">Back</a>
					@else
						<a href="{{route('case_mast.index',['caseBtn' =>'cr'])}}" class="btn btn-md btn-info pull-right">Back</a>
					@endif
				
				
			</div>
			<div class="box-body" >
				@if($message = Session::get('success'))
					<div class="alert bg-success">
						{{$message}}
					</div>
				@endif
				<div id="mainBody">
					@include('case_management.case.case_details')
				</div>
			</div>
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
	@php
		$case_id = $case->case_id.','.$page_name;
	@endphp
	$('#case_detl').on('click', function(e){
		e.preventDefault();		
		$.ajax({
			type:'GET',
			url:"{{route('case_details',$case->case_id)}}",
			success:function(res){
				//console.log(res);
				$('#mainBody').empty().html(res);
			}
		});
		$('#case_detl').addClass('btn-primary');	
		$('#hearing_detl').removeClass('btn-primary');	
		$('#doc_detl').removeClass('btn-primary');	
		$('#note_detl').removeClass('btn-primary');	
	});

	$('#hearing_detl').on('click', function(e){
	e.preventDefault();		
		// alert("hearing_detl");	
		$.ajax({
			type:'GET',
			url:"{{route('case_hearing.show',$case_id)}}",
			success:function(res){
				 //console.log(res);
				$('#mainBody').empty().html(res);
			}
		});	
		$('#hearing_detl').addClass('btn-primary');	
		$('#case_detl').removeClass('btn-primary');	
		$('#doc_detl').removeClass('btn-primary');	
		$('#note_detl').removeClass('btn-primary');	
	});

		$('#doc_detl').on('click', function(e){
		e.preventDefault();		
			$.ajax({
				type:'GET',
				url:"{{route('case_doc.show',$case_id)}}",
				success:function(res){
					// console.log(res);
					$('#mainBody').empty().html(res);
				}
			});	
			$('#doc_detl').addClass('btn-primary');	
			$('#case_detl').removeClass('btn-primary');	
			$('#hearing_detl').removeClass('btn-primary');	
			$('#note_detl').removeClass('btn-primary');		
		});

		$('#note_detl').on('click', function(e){
		e.preventDefault();		
		
			$.ajax({
				type:'GET',
				url:"{{route('case_notes.show',$case_id)}}",
				success:function(res){
					// console.log(res);
					$('#mainBody').empty().html(res);
				}
			});		
			$('#note_detl').addClass('btn-primary');	
			$('#case_detl').removeClass('btn-primary');	
			$('#hearing_detl').removeClass('btn-primary');		
			$('#doc_detl').removeClass('btn-primary');	
		});
           
	});
  
</script>
@endsection