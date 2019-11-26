@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
	    <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>
              <h4>Cases</h4>
              <span>Running: 0 | Closed : 0 | Transfed/NOC : 0 | Direction Matter : 0  | Order Reserved : 0</span>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="{{('case_mast.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($user->clients)}}</h3>

              <h4>Total Clients</h4>
              </br></br>
              <span></span>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{route('clients.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{count($user->messages)}}</h3>

              <h4>Message</h4></br></br>
            </div>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
    <div class="row">

      <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>0</h3>
              <h4>Appointment</h4>
              <span>Unconfirmed : 0 | Confirmed : 0 | Cancelled Request : 0 </span>
            </br><br>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box " style="color:white; background-color: #5c6a77">
            <div class="inner">
              <h3>0</h3>
              <h4>Document</h4>
            </br></br>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-md-4 ">
  
          <div class="small-box" style="background-color: #df6c6f; color:white;">
            <div class="inner">
              <h3>{{count($user->members)}} </h3>
              <h4>Team Member</h4>
              </br></br>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    <div class="row">
      <div class="col-md-4 ">
      <!-- small box -->
        <div class="small-box" style="background-color: #23bab5; color: white">
          <div class="inner">
            <h3>0</h3>

            <h4>To-dos</h4>
            <span>Pending : 0 | Complete: 0</span>
          </br></br>
          </div>
          <div class="icon">
            <i class="fa fa-list-alt"></i>
          </div>
          <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      {{-- <div class="col-md-4 ">
      <!-- small box -->
        <div class="small-box" style="background-color: #5da3d4; color: white">
          <div class="inner">
            <h3>0</h3>

            <h4>Invoices</h4>
            <span>Dialy : 0 | Saint: 0 | Paid: 0 | Partially Paid: 0 | Draft & Partially Paid : 0 |</span>
          </div>
          <div class="icon">
            <i class="fa fa-inr"></i>
          </div>
          <a href="{{route('case_diary.index',['caseBtn' =>'ca'])}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div> --}}
    </div>
      <div class="row">
        <div class="col-md-6" >
            <div class="box box-primary " style="height: 300px;">
            <div class="box-header">
              <i class="fa fa-list"></i>
              <h3 class="box-title">Pending To-Dos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height: 200px;">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <li>
                  <label>September 17, 2019</label>
                  <br>
                  <span class="label label-success">2:00 PM</span>
                  <span>Design a nice theme</span>
                 
                {{--   <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete--> --}}
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right">More info <i class="fa fa-arrow-circle-right"></i></button>
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add Todo</button>
            </div>
          </div>
        </div>

        <div class="col-md-6" >
            <div class="box box-primary " style="height: 300px;">
            <div class="box-header">
              <i class="fa fa-list"></i>
              <h3 class="box-title">Upcoming Hearing Dates</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height: 200px;">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <li>
                  <label>September 17, 2019</label>
                  <br>
                  <span>Original Suit 1231 / 2019 - case</span>
                 
                  <!-- todo text -->
                {{--   <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small> --}}
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right">More info <i class="fa fa-arrow-circle-right"></i></button>
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add Hearing</button>

            </div>
          </div>
        </div>
      </div>
    {{--   <div class="row">
        <div class="col-md-12">
          <div class="box box-primary" style="height: 300px;">
            <div class="box-header">
              <h3 class="box-title">Recent Activity</h3>
            </div>
            <div class="box-body" style="height: 200px;">
                 
              <ul class="todo-list">
                <li>
                  <label>September 17, 2019</label>
                  <br>
                  <span>Original Suit 1231 / 2019 - case</span>
                 
                  <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
               
              </ul>
            </div>
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right">More info <i class="fa fa-arrow-circle-right"></i></button>
               
            </div>
          </div>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h4 class="box-title">Calendar</h4>
            </div>
            <div class="box-body">
              <div id="calendar"></div>
              <br>
              <div class="row">
                  <div class="col-md-12 text-center">
                    <label><i class="fa fa-square" style="color: #ff4566; height: 25px;width: 20px;"></i> Member To-dos</label>
                    <label><i class="fa fa-square" style="color: #fda503; height: 25px;width: 20px;"></i> Everyone To-dos</label>
                    <label><i class="fa fa-square" style="color: #8259ff; height: 25px;width: 20px;"></i> Hearing Morning Session</label>
                    <label><i class="fa fa-square" style="color: #0cab0a; height: 25px;width: 20px;"></i> Hearing Evening Session</label>
                  </div>
              </div>
                @include('calendar.calendar_modal')
            </div>
          </div>
        </div>
      </div>
        <!-- ./col -->
        {{-- <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3></h3>

              <p>Unconfirmed Appointment</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

              <p>Confirmed Appointment</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div> --}}

{{-- <div class="row">
	
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3></h3>
              <p> Cancelled Appointment</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3></h3>

              <p>Total Practicing in Courts</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3></h3>

              <p>Total Landmark Case</p>
            </div>
            <div class="icon">
              <i class="fa fa-gavel"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3></h3>

              <p>Total area of Specializations</p>
            </div>
            <div class="icon">
              <i class="fa fa-balance-scale"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
</div>
<div class="row">
    <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3></h3>

          <p>All Cases</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3></h3>

          <p>On Going Cases</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

     <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>0</h3>

          <p>Today's Cases</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

     <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0</h3>

          <p>Cases of This Week</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

</div>


	 --}}
		

	</section>
  <script>
@if($message = Session::get('success'))
  alert("{{$message}}");
@endif
    $(document).ready(function() {
      $('#calendar').fullCalendar({        
          header: {
          right: 'prev today next ',
          center: 'title',
          left: 'month,agendaDay'
          },
          defaultView: 'month',
          height: 550,
          navLinks: true,
          editable: false,
          eventLimit: true,
          selectable : true,
          events: [
           
          @foreach($hearings as $hearing)
          {
            id: '{{$hearing->case_tran_id}}',
            title:'{{$hearing->case->case_title}}',
            description: 'Hearing Date: {{date('d-m-Y', strtotime( $hearing->hearing_date))}} <br> Client Name: {{$hearing->client->cust_name}}<br> Start Time: {{$hearing->start_time}} <br> Lawyer Name: <?php $law_data = json_decode($hearing->lawyer_names) ;  
            foreach ($law_data as $value) {
              $user = \App\User::find($value);
              echo $user->name .', ';
              } 
              ?> <br> Judges Name: <?php 
                $law_data = json_decode($hearing->judges_name) ;
                foreach ($law_data as $value) {
                  echo $value .', ';
              } 
            ?>',
            color:'{{date('G',strtotime($hearing->start_time)) > '12' ? '#0cab0a' : '#8259ff' }}',
            start: '{{$hearing->hearing_date}}',
            end: '{{$hearing->hearing_date}}',

        },
        @endforeach
        @foreach($todos as $todo)
        { 
          id: '{{$todo->id}}',
          title: '{{$todo->title}}',
          description: '{{$todo->description}}',
          color: '{{$todo->user_id == $todo->team_id ? '#fda503': '#ff4566'}}',
          url : '{{route('todos.show',$todo->id)}}',
          start: '{{$todo->start_date}}',
          end: '{{$todo->end_date}}',
        },
        @endforeach
        
      ],
        eventMouseover: function(calEvent, jsEvent) {
            var tooltip = '<div class="tooltipevent text-center" style="width:200px;min-height:100px;background:orange;position:absolute;z-index:10001; padding:5px;">' + calEvent.description + '</div>';
            $("body").append(tooltip);
            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.tooltipevent').fadeIn('500');
                $('.tooltipevent').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.tooltipevent').css('top', e.pageY + 10);
                $('.tooltipevent').css('left', e.pageX + 20);
            });
        },

        eventMouseout: function(calEvent, jsEvent) {
             $(this).css('z-index', 8);
             $('.tooltipevent').remove();
        },
        select: function(start, end, jsEvent, view) {
          
          var start_date = moment(start).format('YYYY-MM-DD');
          var end_date =  moment(end).subtract(1, 'days').format('YYYY-MM-DD');     
          $('.start_date').val(start_date);
          $('.end_date').val(end_date);
          $('#calendar_modal').modal('show');
               
        }
      });
    });
  </script>
@endsection


