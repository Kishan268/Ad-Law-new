@extends('admin.main')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="">Court <a href="{{route('court_subcategory.create')}}" class="btn btn-sm btn-primary pull-right">Add Court </a></h3>
          </div>
          <div class="box-body">
            @if($message = Session::get('success'))
              <div class="alert bg-success">
                {{$message}}
              </div>
            @endif
            <table class="table table-striped table-bordered" id="myTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Court Name</th>
                  <th>Court Short Name </th>
                  <th>Court Group Name </th>
                  <th>Court Type Name </th>
        
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php  $count =0 ; @endphp
                @foreach($courts as $court)                
                  <tr>
                    <td>{{++$count}}</td>
                     <td>{{$court->court_name}}</td>
                     <td>{{$court->court_shrt_name}}</td>
                     <td>{{$court->court_group_name}}</td>
                     <td>{{$court->court_type_name}}</td>
                     <td>
                    <form action="{{route('court_subcategory.destroy', ['id' =>  $court->court_code ])}}" method="POST" id="delform_{{ $court->court_code }}">
                        @method('DELETE')
                        <a href="{{route('court_subcategory.edit',['id'=>$court->court_code])}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

                        <a href="javascript:$('#delform_{{ $court->court_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

                        @csrf
                      </form>



                     </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
<script type="text/javascript">
  $(document).ready(function(){
  
    $('#myTable').DataTable();
    });
</script>
@endsection