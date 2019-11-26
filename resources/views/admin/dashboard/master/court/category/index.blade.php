@extends('admin.main')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="">Court Type <a href="{{route('court_category.create')}}" class="btn btn-sm btn-primary pull-right">Add Court Type</a></h3>
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
                  <th>Court Type Name</th>
                  <th>Short Name </th>
                  <th>Court Group Name </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php  $count =0 ; @endphp
                @foreach($court_types as $court_type)                
                  <tr>
                    <td>{{++$count}}</td>
                     <td>{{$court_type->court_type_desc}}</td>
                     <td>{{$court_type->short_desc}}</td>
                     <td>{{$court_type->court_group_name}}</td>
                     <td>
                      <form action="{{route('court_category.destroy', ['id' =>  $court_type->court_type ])}}" method="POST" id="delform_{{ $court_type->court_type }}">
                        @method('DELETE')

                        <a href="{{route('court_category.edit',['id'=>$court_type->court_type])}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

                        <a href="javascript:$('#delform_{{ $court_type->court_type }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

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