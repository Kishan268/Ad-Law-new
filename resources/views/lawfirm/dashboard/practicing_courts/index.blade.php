@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
    <div class="col-md-7">
        <div class="box box-primary ">
          <div class="box-header with-border"> 
          <h3 class="box-title">Select which practicing courts you have work</h3>
          </div>
          <div class="box-body">
              <div class="parts-selector" id="parts-selector-1">
                  <div class="parts list h-40vh">
                    <h3 class="list-heading top-fixed">All Practicing Courts</h3>
                    <ul>
                      @foreach($mast_courts as $court)
                      <li >
                        <input type="hidden" name="valuCourt[]" value="{{$court->court_code}}" id="valuCourt">
                        {{ $court->court_name}}
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="controls">
                      <a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
                      <a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
                      </div>
                      <div class="selected list">
                        <h3 class="list-heading">Your Practicing Court</h3>
                      
                        <ul id="lcourt">
                          @foreach($lawyerCourt as $courts)
                            <li ><input type="hidden" name="valuCourt[]" value="{{$courts->court_catg->court_code}}" id="valuCourt">{{$courts->court_catg->court_name}}
                            </li>
                          @endforeach
                        </ul>
                      </div>
              </div>
              <button class="btn btn-sm btn-primary" id="submit">Submit</button>

            </div>  
        </div>
    </div>
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border ">
              <h3 class=" box-title">Your Practicing Courts</h3>
            </div>
            <div class="box-body">
              @foreach($lawyerCourt as $courts)
              <p class="m-1"><i class="fa fa-gavel" aria-hidden="true"></i>&nbsp; {{$courts->court_catg->court_name}}                
              </p>
              @endforeach
            </div>
        </div>
    </div>
</div>
</section>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

       $(function() {
        $( "#parts-selector-1" ).partsSelector();

      });

       $('#submit').on('click',function(e){
          e.preventDefault();
          var courts = $("#lcourt input[name='valuCourt[]']")
                .map(function(){return $(this).val();}).get();
          
          if(courts != ''){
            $.ajax({
              type:'POST',
              url:"{{route('practicing_court.store')}}",
              data: {court:courts},
              success:function(data){
                swal({
                    text: data,
                    icon : 'success',
                  });
                  setTimeout(function(){// wait for 5 secs(2)
                     location.reload(); // then reload the page.(3)
                  }, 3000); 
              }
            });
          }
          else{
            swal({
                text: 'Add Practicing Court',
                icon : 'warning',
              });
              setTimeout(function(){// wait for 5 secs(2)
                 location.reload(); // then reload the page.(3)
              }, 3000); 
            
          }
        });


    });
</script>
@endsection