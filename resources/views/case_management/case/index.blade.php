@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12 m-auto"  >
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
             @if(Auth::user()->parent_id == null)
              <a href="{{route('case_mast.create', ['cust_id'=>",case_diary"])}}" class="btn btn-md btn-primary ">Add New Case</a>
              @endif
            </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
                @if($message = Session::get('success'))
                  <div class="alert bg-success">
                      {{$message}}
                  </div>
                @endif  
            </div>
          </div>
            
        </div>
        <div class="box-body table-responsive" id="table_div">
   
        </div>
        </div>
      </div>
    </div>
  </section>
<script>
	$(document).ready(function (){
      var case_status =  $('select[name="case_status"] option:selected').val();
      var case_status_text =  $('select[name="case_status"] option:selected').text();
      
      if(case_status !=''){
        var cust_id ='';
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