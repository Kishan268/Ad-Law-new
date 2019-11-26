@extends('admin.main')
@section('content')
<section class="content">
<div class="row">
  <div class="col-md-12 col-xs-12 col-sm-12 m-auto">
    <div class="box box-primary ">
      <div class="box-header with-header">
          <h3 class="box-title">All Blog User</h3> 
      </div>
      <div class="box-body table-full-width table-responsive pt-2 pb-2">
        <table class="table table-hover table-striped table-bordered" id="blogTable">
          <thead>
            <tr class="row">
              <th>SNo.</th>
              <th>User Name</th>
              <th>Category</th>
              <th>Grand Permission</th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 0; ?>
            @foreach($bloguser as $user)
            <tr class="row">
              <td>{{++$count}}</td>
              <td>{{ $user->name}}</td>
              <td>{{ $user->role->display_name}}</td>
              <td><a href="#" data-target="#my_modal" data-toggle="modal" class="identifyingClass" data-id="{{$user->id}}">Open Modal</a>
</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

  <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
<div class="modal-dialog" role="dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal Title</h4>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.blogpremission')}}" method="post"> 
            @csrf
               <table class="table table-hover table-striped table-bordered" id="blogTable">
          <thead>
          
            <tr>
              <th>S.no</th>
              <th>User Name</th>
              <th>Category</th>
              <th>Grand Permission</th>
            </tr>
            
          </thead>
          <tbody>
            <?php $count = 0; ?>
            @foreach($permission as $permis)
            <tr>
              <td>{{++$count}}</td>
              <td>{{ $permis->name}}<input type="hidden" name="user_id" value="" id="hiddenValue"></td>
              <td>{{ $permis->display_name}}</td>
              <td><a><input type="checkbox" name="hiddenValue[]"  value="{{ $permis->id}}"/></a></td>
            </tr>
              @endforeach
          </tbody>
        </table>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
        </div>
         </form>
       </div>
     </div>
    </div>
</div>
    </div>
  </div>
</div>
</section>
<script>
  $(document).ready(function(){
    $('#blogTable').DataTable();
        $(".identifyingClass").click(function () {
            var my_id_value = $(this).data('id');
            alert(my_id_value);
            $(".modal-body #hiddenValue").val(my_id_value);
        })
    });
</script>

@endsection