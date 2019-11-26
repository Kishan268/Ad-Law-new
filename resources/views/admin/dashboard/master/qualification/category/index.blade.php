@extends('admin.main')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="">Qualification Category <a href="{{route('qual_category.create')}}" class="btn btn-sm btn-primary pull-right">Add Category</a></h3>
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
                  <th>Qualification Name</th>
                  <th>Qualification Short Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php  $count =0 ; @endphp
                @foreach($qualifics as $qual)                
                  <tr>
                    <td>{{++$count}}</td>
                     <td>{{$qual->qual_catg_desc}}</td>
                     <td>{{$qual->shrt_desc}}</td>
                     <td>
                      <form action="{{route('qual_category.destroy', ['id' =>  $qual->qual_catg_code ])}}" method="POST" id="delform_{{ $qual->qual_catg_code }}">
                      @method('DELETE')

                      <a href="{{route('qual_category.edit',['id'=>$qual->qual_catg_code])}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

                               
                      <a href="javascript:$('#delform_{{ $qual->qual_catg_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

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