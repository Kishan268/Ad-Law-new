@extends('admin.main')
@section('content')
<section class="content">

<div class="row">
	<div class="col-md-12" >
		<div class="box box-primary">
			<div class="box-header with-border ">
				<div class="box-title ">
        	<h5>
            <a class="btn btn-sm btn-info" id="pendingRevBtn" >Pending Reviews</a> 
            <a id="approveRevBtn" class="btn btn-sm btn-default " >Approve Reviews</a>
            <a id="allRevBtn" class="btn btn-sm btn-default" >All Reviews</a>
          </h5>

        </div>
			</div>
			<div class="box-body table-responsive" id="pendingRevBody" >
				<div class="text-right" > <a href="" class="btn btn-sm btn-success" id="approve" >Approve</a> <a href="" class="btn btn-sm btn-danger" id="decline">Decline</a></div>
				<table class="table table-striped table-bordered dataTable" id="myTable">
					<thead>
						<tr class="row">
							<th style="padding-left: 10px"><input type="checkbox" id="all_check"></th>
							<th>SNo.</th>
							<th>Name</th>
							<th>Review</th>
							<th>Review Date</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php $count=0; ?>
						@foreach($pending_reviews as $pending_review)

						<tr class="row">
							<td><input type="checkbox" name="review_ids[]" id="reviewCheckbox" value="{{$pending_review->review_id}}" ></td>
							<td>{{++$count}}</td>
							<td>{{ $pending_review->name }}</td>

							<td class="review-text">

                <span class="halfText">{{ str_limit($pending_review->review_text, $limit=60, $end='...')}}</span>

                <span class="full-text" style="display: none">{{$pending_review->review_text}}</span> 

                <a href="" class="readmore">Read more</a>
                <a href="" class="readless" style="display: none">Read less</a>
              </td>

							<td>{{ $pending_review->review_date }}</td>

							<td>
                <a href="{{route('admin.active_pending_reviews', ['review_id' => $pending_review->review_id] )}}" class="btn btn-sm btn-success text-white">
                  <i class="fa fa-check-circle"></i>
                </a>
								<a href="{{route('admin.decline_pending_reviews',$pending_review->review_id)}}" class="btn btn-sm btn-danger">
                  <i class="fa fa-ban"></i>
                </a>
              </td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>

        <div class="box-body table-full-width table-responsive" id="approveRevBody" style="
        display: none">
       
        <table class="table table-striped table-bordered" id="myTable2">
          <thead>
            <tr>
              <th>SNo.</th>
              <th>Name</th>
              <th>Review</th>
              <th>Review Date</th>
            </tr>
          </thead>
          <tbody>
           <?php $count=0; ?>
            @foreach($active_reviews as $active_review)
            <tr style="font-size:15px;">
              
              <td>{{++$count}}</td>
              <td>{{$active_review->name}}</td>
              <td> 
                <span class="halfText">{{ str_limit($active_review->review_text, $limit=50, $end='...')}}</span>

                <span class="full-text" style="display: none">{{$active_review->review_text}}</span> 

                <a href="" class="readmore">Read more</a>
                <a href="" class="readless" style="display: none">Read less</a></td>

              <td>{{$active_review->review_date}}</td>
             
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
      
		</div>
	</div>

</div>


</section>

<script>
	$(document).ready(function (){
    $('#pendingRevBtn, #approveRevBtn').on('click', function(){
      $('#pendingRevBody').toggle();
      $('#approveRevBody').toggle();

      $('#pendingRevBtn').toggleClass('btn-info btn-default');
      $('#approveRevBtn').toggleClass('btn-info btn-default');

    });
    

	$('#myTable, #myTable2').DataTable({
        	searching:false,
        	scrolling:true,
		});

   	$('#all_check').change( function(){
   		$('input:checkbox').not(this).prop('checked', this.checked);
   	}); 

	$.ajaxSetup({
	  headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

   	$('#approve').on('click',function(e){
   		e.preventDefault();
   		var review_ids = [];
   		 $('input[name="review_ids[]"]:checked').each(function(){
            review_ids.push($(this).val());
        });
   		if(review_ids != ''){
   		 $.ajax({
   		 	type:'POST',
   		 	url : "{{route('admin.active_all_reviews')}}",
   		 	data: {review_ids:review_ids},
   		 	success:function(data){
   		 	swal({
   		 			title: "Review Approved",
   		 			text : data,
   		 			type : 'success',
   		 	});
   		 	 setTimeout(function(){// wait for 5 secs(2)
                 location.reload(); // then reload the page.(3)
              }, 5000); 

   		 	}

   		 });
   		}
   		else{
   			alert('Please Select review checkbox');
   		}
   	});

   	$('#decline').on('click',function(e){
   		e.preventDefault();
   		var review_ids = [];
   		 $('input[name="review_ids[]"]:checked').each(function(){
            review_ids.push($(this).val());
        });
   		if(review_ids != ''){
   		 $.ajax({
   		 	type:'POST',
   		 	url : "{{route('admin.decline_all_reviews')}}",
   		 	data: {review_ids:review_ids},
   		 	success:function(data){
   		 	swal({
   		 			title: "Review Approved",
   		 			text : data,
   		 			type : 'success',
   		 	});
   		 	 setTimeout(function(){// wait for 5 secs(2)
                 location.reload(); // then reload the page.(3)
              }, 5000); 

   		 	}

   		 });
   		}
   		else{
   			alert('Please Select review checkbox');
   		}
   	});
   
    $('.readmore, .readless').on('click',function(e){
       e.preventDefault();
       $(this).parent().find('.halfText').toggle();
        
       $(this).parent().find('.full-text').toggle();
       $(this).parent().find('.readmore').toggle();
       $(this).parent().find('.readless').toggle();
    });


     	
});
</script>
@endsection