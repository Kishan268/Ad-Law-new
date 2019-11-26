<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel = "icon" href ="{{asset('images/adlaw-logo.png')}}" type = "image/x-icon" style="line-height: 40px;">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>ADLAW</title>

  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>
  <!-- Bootstrap CSS CDN -->

  <link rel="stylesheet" href="{{asset('adlaw_files/css/bootstrap.min.css')}}">
  <!-- Fontawesome icon CDN -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{asset('adlaw_files/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('adlaw_files/css/jquery-jvectormap.css')}}">
  <link rel="stylesheet" href="{{asset('adlaw_files/css/adlaw.min.css')}}">
  <link rel="stylesheet" href="{{asset('adlaw_files/css/_all-skins.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/parts-selector.css')}}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
  <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard/dashboard.css')}}"> 
  
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
  <style type="text/css">
   .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #247ae4;
    }
    .locked-tag .select2-selection__choice__remove{
    display: none!important;
  }

  .select2{
    width: 100% !important;
  }
/*    .select2-selection__choice__remove,.select2-selection__clear{display:none !important;} */
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@php

    $msg = \App\Models\MessageTalk::where('recv_id',Auth::user()->id)->where('status',0)->get();         
    $users = \App\User::join('comp_mast_view', 'users.parent_id', '=','comp_mast_view.parent_id')->where('users.id',Auth::user()->id)->first();

    $company_name = !empty($users->comp_name) ? $users->comp_name : '';

    $unbookings =  \App\Models\Booking::where('user_id',Auth::user()->id)
                ->where('client_status',1)
                ->where('user_status',0)
                ->get();  
              
    $messages = \App\Models\MessageTalk::select('msg_talks.*','users.name','users.photo')->join('users','users.id','=','msg_talks.sender_id')->where('recv_id',Auth::user()->id)->where('msg_talks.status',0)->get();

    $lawyer_pen = \App\User::with('state','city')->where('parent_id',Auth::user()->id)->where('user_flag','=','P')->get();

  @endphp

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LW</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ADLAW</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              @if(count($messages) !=0)
                <span class="label label-success">{{count($messages)}}</span>
              @endif
            </a>
             @if(count($messages) !=0)
              <ul class="dropdown-menu">
                <li class="header">You have {{count($messages)}} messages</li>             
                <li>
                <ul class="menu">
                  @foreach($messages as $message)
                  <li><!-- start message -->
                    <a class="" href="{{route('message.show',['id'=>$message->id])}}">
                      <div class="pull-left">
                        @if($message->photo !='')
                          <img src="{{ asset('storage/profile_photo/'.$message->photo)}}" class="img-circle" alt="Sender Image" />
                        @else
                          <img src="{{asset('storage/profile_photo/default.png')}}"  class="img-circle" alt="Sender Image" /> 
                        @endif
                      </div>
                      <h4>
                        {{$message->name}}
                        <small>{{date('d-m-Y',strtotime($message->created_at))}}</small>
                      </h4>
                      <p>{{mb_substr($message->message,0,20).'...'}}</p>
                    </a>
                  </li>
                  @endforeach     
                 
                </ul>

              </li>
              <li class="footer"><a href="{{route('message.index')}}">See All Messages</a></li>
            </ul>
             @endif
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"></span>
            </a>            
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
          </li> -->
            
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if(Auth::user()->photo !='')
                    <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}" class="user-image" alt="User Image" />
                @else
                    <img src="{{asset('storage/profile_photo/default.png')}}"  class="user-image" alt="User Image" /> 
                @endif
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(Auth::user()->photo !='')
                  <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}" class="img-circle" alt="User Image" />
                @else
                  <img src="{{asset('storage/profile_photo/default.png')}}"  class="img-circle" alt="User Image" /> 
                @endif

                <p>{{Auth::user()->name}}</p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('lawfirm.show',Auth::user()->id)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                      </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           @if(Auth::user()->photo !='')
            <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}" class="img-circle" alt="User Image" />
            @else
            <img src="{{asset('storage/profile_photo/default.png')}}"  class="img-circle" alt="User Image" /> 
            @endif
          
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Welcome to adlaw </li>
        <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'lawfirm/' ? 'active' : '' }} nav-item " >
            <a class="nav-link"  href="{{route ('lawfirm.index')}}">
               <i class="fa fa-tachometer"></i>
              <span >Dashboard</span>
            </a>
          </li>
          <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'lawfirm/'.Auth::user()->id ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('lawfirm.show',Auth::user()->id)}} ">
              <i class="fa fa-user"></i>
              <span >My Profile</span>
            </a>
          </li>
          @role('lawyer')
           <li class="{{Request()->segment(1) == 'specialization' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('specialization.index')}}">
              <i class="fa fa-balance-scale"></i>
              <span >Area Of Specialization</span>
            </a>
          </li>
          @endrole
            <li class="{{Request()->segment(1) == 'practicing_court' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('practicing_court.index')}}">
              <i class="fa fa-university"></i>
              <span >Practicing in courts</span>
            </a>
          </li>  

          @role('lawyer')
          <li class="{{Request()->segment(1) == 'qualification' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('qualification.index')}}">
              <i class="fa fa-graduation-cap"></i>
              <span >Qualification</span>
            </a>
          </li>
          @endrole
          @php 
            $segment = Request()->segment(2);
            $segment = explode(',', $segment);
            if(isset($segment[1])){
                $page_name = $segment[1];
            }  
            else{
              $page_name = ' ';
            }           

          @endphp
           <li class="{{Request()->segment(1) == 'clients' ? 'active' : '' }} {{$page_name == 'clients' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('clients.index')}}">
              <i class="fa fa-users"></i>
              <span >My Clients</span>
            </a>
          </li>
       
          <li class="{{Request()->segment(1) == 'case_diary' ? 'active' : '' }} {{$page_name == 'case_diary' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('case_mast.index')}}">
              <i class="fa fa-book"></i>
              <span >Case Diary</span>             
            </a>
          </li>
          <li class="{{Request()->segment(1) == 'appointment' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('appointment.index')}}">
              <i class="fa fa-calendar"></i>
              <span >Schedule Appointment</span>
            </a>
          </li>
           
    
           <li class="{{Request()->segment(1) == 'booking' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('booking.index')}}">
              <i class="fa fa-briefcase"></i>
              <span >Appointments</span>
                @if(count($unbookings) !=0) 
                  <span class="pull-right-container">
                    <span class="label bg-orange pull-right">{{count($unbookings)}}</span>
                 </span>
                @endif
            </a>
          </li> 
           <li class="{{Request()->segment(1) == 'message' ? 'active' : '' }} {{Request()->segment(1) == 'sent_messages' ? 'active' : '' }} {{Request()->segment(1) == 'trash_message' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('message.index')}}">
              <i class="fa fa-envelope"></i>
              <span >Mailbox </span>
             @if(count($msg) !=0) 
                <span class="pull-right-container">
                  <span class="label bg-red pull-right">{{count($msg)}}</span>
                </span>
              @endif

            </a>
          </li>
      
        <li class="{{Request()->segment(1) == 'calendar' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('calendar.index')}}">
            <i class="fa fa-calendar"></i>
            <span>Calendar</span>
            </a>
        </li>

       
        <li class="{{Request()->segment(1) == 'todos' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('todos.index')}}">
            <i class="fa fa-tasks"></i>
            <span >Todos</span>
            </a>
        </li>
     

        @role('lawcompany')
        <li class="{{Request()->segment(1) == 'teams' ? 'active' : '' }} nav-item">
          <a class="nav-link" href="{{route('teams.index')}}">
            <i class="fa fa-users"></i>
            <span>My Team Member</span>
             @if(count($lawyer_pen) !=0) 
                <span class="pull-right-container">
                  <span class="label bg-orange pull-right">{{count($lawyer_pen)}}</span>
                </span>
              @endif
          </a>
        </li>
        @endrole

      
        {{-- @endif --}}

{{--           @role('lawyer')
           @if($company_name)
              <li class="header">Welcome to {{$company_name}} </li>
              <li class="{{Request()->segment(1) == 'company_profile' ? 'active' : '' }} treeview">
                  <a href="#">
                  <i class="fa fa-university"></i>
                  <span>{{$company_name}}</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  
                </a>
                <ul class="treeview-menu">
                  <li class="{{Request()->segment(1) == 'company_profile' ? 'active' : '' }}"><a href="{{route('lawfirm.company_profile')}}" ><i class="fa fa-user"></i> Profile</a></li>
                  <li><a href=""><i class="fa fa-circle-o"></i> Allot Case</a></li>
              
                </ul>
            </li>


            @endif   

            @endrole
 --}}

           {{--  <li class="header bg-red"><p style="padding-top:8px; padding-bottom: 0px; font-size: 12px; ">Launching Soon..</p></li> --}}
        
          {{-- <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-bell"></i>
              <span >Notifications</span>
            </a>
          </li>


           <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-briefcase"></i>
              <span >My Brief Case</span>
            </a>
          </li> --}}

         
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-capitalize">{{__('Dashboard')}}</h1>

      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>

        {{-- <li class="active text-capitalize">{{(__('lawyer'))}}</li> --}}
        @if(Request()->segment(1) != '')
          <li class="active text-capitalize">{{Request()->segment(1)}}</li>
        @endif
      </ol>
    </section>
