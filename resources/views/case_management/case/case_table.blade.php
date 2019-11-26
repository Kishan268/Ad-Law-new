<table class="table table-striped table-bordered myTable" >
   <thead>
       <tr>
          <th>SNo.</th>
  				<th>Case Title</th>  			
  				<th>Client Name</th>
          <th>Court Name</th>
          <th>Member of case</th>
          <th>Case Registration Date</th>
          @if($case_status != 'cr')<th>Case Over Date</th>@endif
          <th>Action</th>
      
       </tr>
  </thead>
  <tbody>

     @php $count=0; @endphp
     @foreach($cases as $case)
     @if($case->case !=null)

     <tr>   
  			<td>{{++$count}}</td>
        <td>{{$case->case->case_title}}</td>
        <td>{{$case->case->client->cust_name}}</td>
  			<td>{{$case->case->court->court_type_desc}}</td>
        <td>
          @foreach($case->case->members as $value)
            @php 
              if($value->deallocate_date == null){
                  $names[] = $value->member->name;  
              }
            @endphp
          @endforeach 

          @php 
            echo implode(', ', $names);
            $names = [];  
          @endphp
        </td>

  			<td>{{$case->case->case_reg_date}}</td>
       @if($case_status != 'cr') <td>{{$case->case->case_over_date}}</td>@endif
        <td>
            <form action="{{route('case_mast.destroy', ['cust_id' =>  $case->case->case_id ])}}" method="POST" id="delform_{{ $case->case->case_id }}">
            @method('DELETE')
        
            @if(Auth::user()->parent_id ==null)  <a href="{{route('case_mast.edit', $case->case->case_id.','.$page_name)}}" ><i class=" fa fa-edit text-green" style="font-size: 16px  ; margin-left: 10px;"></i></a>
              <a href="javascript:$('#delform_{{ $case->case->case_id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class=" fa fa-trash text-red" style="font-size: 16px ; margin-left: 10px;"></i></a>              
            @endif
              <a href="{{ route('case_mast.show',$case->case->case_id.','.$page_name)}}" class=""><i class=" text-primary fa fa-eye" style="font-size: 16px ; margin-left: 10px;"></i></a>              
          
            @csrf
            </form>
        </td>
     </tr>

    @endif
    @endforeach
    
  </tbody>
</table>
<script type="text/javascript">
  $('.myTable').DataTable({
          searching:true,
          scrolling:true,
          
    });
  
</script>