@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-7 col-sm-7">
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Select which field you have work</h3>
          </div>
          <div class="box-body ">
            <div class="parts-selector" id="parts-selector-1">
                <div class="parts list h-40vh">
                    <h3 class="list-heading top-fixed">Select Specialization</h3>
                  <ul>
                  @foreach($specc as $speciality)
                    <li id="{{$speciality->catg_code}}">
                    <input type="hidden" name="valuSpeci[]" value="{{$speciality->catg_code}}" id="valuSpeci" />{{$speciality->catg_desc }}
                    </li>
                  @endforeach
                  </ul>
                </div>
                <div class="controls">
                  <a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
                  <a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
                </div>
               
                <div class="selected list">
                  <h3 class="list-heading">Add Specialization</h3>
                  <ul id="lspec">
                    @foreach($lawyerSpecc as $spect)
                      <li><input type="hidden" name="valuSpeci[]" value="{{$spect->specialization_catgs->catg_code}}" id="valuSpeci" />{{$spect->specialization_catgs->catg_desc}}</li>
                    @endforeach
                  </ul>
                </div>
            </div> 
            <button class="btn btn-md btn-primary" id="submit">Submit</button>
          </div>
      </div><br>
    
    </div>

    <div class="col-md-5 col-sm-5">
       <div class="box box-primary">
          <div class="box-header with-border">
    	       <h5 class="box-title">Area of specialization</h5>
          </div>
          <div class="box-body ">
          	@foreach($lawyerSpecc as $spect)
          		<p class="m-1"><i class="fa fa-balance-scale"></i> {{$spect->specialization_catgs->catg_desc}}</p>
          	@endforeach
          </div>
      </div> 
    </div>
  </div>
</section>


  <script type="text/javascript">
      $(document).ready(function() {
          $(function() {
          $( "#parts-selector-1" ).partsSelector();

        });
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $('#submit').on('click',function(e){
            e.preventDefault();
            var specc = $("#lspec input[name='valuSpeci[]']")
                  .map(function(){
                    return $(this).val();
                  }).get();

          
            var specc_name = [];
            $("#lspec li").each(function() { 
              specc_name.push($(this).text()) 
            });
        
         
            if(specc != ''){
            	$.ajax({
            		type:'POST',
            		url:"{{route('specialization.store')}}",
            		data: {specc_code:specc, specc_name:specc_name},
            		success:function(data){

            		swal({
                    text: data,
                    icon : 'success',
                  });

                   setTimeout(function(){ 
                      location.reload(); 
                   }, 3000); 

            		}
            	});
            }
            else{
                swal({
                  text: 'Add Specialization',
                  icon: 'warning',
                });
          
            }

          });
       
      });
  </script>
@endsection