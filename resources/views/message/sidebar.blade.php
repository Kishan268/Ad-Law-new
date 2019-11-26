@extends(Auth::user()->user_catg_id == 2 ? 'lawfirm.layouts.main' : (Auth::user()->user_catg_id == 3 ? 'lawfirm.layouts.main' : 'customer.main'))
@section('content')
 <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="{{Request()->segment(1) == 'message' ? 'active' : ''}}"><a href="{{route('message.index')}}"><i class="fa fa-inbox"></i> Inbox
                	@if($unread != 0)
                  	<span class="label label-primary pull-right">{{$unread}}</span></a></li>
                  	@endif
                <li class="{{Request()->segment(1) == 'sent_messages' ? 'active' : ''}}"><a href="{{route('message.sent')}}"><i class="fa fa-envelope-o"></i> Sent</a></li>
                {{-- <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>                --}}
                {{-- <li class=""><a href=""><i class="fa fa-trash-o"></i> Trash</a></li> --}}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
              </ul>
            </div>
     
          </div>
          <!-- /.box -->
        </div>
	@yield('inbox-body')
@endsection