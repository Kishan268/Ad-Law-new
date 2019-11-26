@extends('layouts.default')
@section('content')
<!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact Us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
    a matter of hours to help you.</p>
    <div class="container">
        <div class="row">
      @if (session('message'))
        <div class="alert alert-success col-md-9">
        {{ session('message') }}
        </div>
        @endif
            <!--Grid column-->
            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 mb-4">
              <div class="card shadow">

                <div class="card-header bg-white  text-center">
                  <h3 class="font-weight-bold">Get in Touch</h3>
                </div>
                <div class="card-body ">
                  <form id="contact-form"  action="{{route('contact.store')}}" method="POST">
                   {{ csrf_field() }}
                     <div class="row form-group">
                        <div class="col-md-6">
                              <label for="fname" class="font-weight-bold">Your First Name <span class="text-danger">*</span> </label>
                              <input type="text" name="fname" class="form-control" placeholder="Enter first name" value="{{old('fname')}}"> 
                              @error('fname')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                              @enderror                  
                        </div>
                        <div class="col-md-6">
                             <label for="name" class="font-weight-bold">Your Last Name <span class="text-danger">*</span> </label>
                              <input type="text" name="lname" class="form-control" placeholder="Enter last name" value="{{old('lname')}}"> 
                              @error('lname')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-6">
                            <label for="cemail" class=" font-weight-bold">Your Email Address<span class="text-danger">*</span></label>
                            <input type="email" id="email" name="cemail" class="form-control" placeholder="Enter email address" value="{{old('cemail')}}">
                            @error('cemail')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror  
                        </div>
                        <div class="col-md-6">
                              <label for="mobile" class="font-weight-bold">Your Mobile Number <span class="text-danger">*</span></label>
                              <input type="text" id="mobile" name="mobile_no" class="form-control" placeholder="Enter mobile number" value="{{old('mobile_no')}}">
                              @error('mobile_no')
                                <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror 
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                            <label for="address" class="font-weight-bold">Your Address </label>
                            <textarea class="form-control" name="address" placeholder="Enter your address" rows="2">{{ old('address')}}</textarea> 
                            @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror 
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                          <label for="message" class="font-weight-bold">Your message</label>
                          <textarea type="text" id="message" name="message" rows="3" class="form-control md-textarea" placeholder="Enter message here...">{{old('message')}}</textarea>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-success" type="submit"> Send Details </button>
                        </div>
                     </div>
                    </form>
                  </div>
                
              </div>
            </div>
                                   <!--Grid row-->
                   {{-- <div class="row"> --}}

                    <!--Grid column-->
               {{--      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                        <div class="md-form mb-0">
                            <label for="name" class=" font-weight-bold">Your name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Name" value="{{old('name')}}"> 
                            @error('name')
                              <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror                       
                        </div>
                    </div> --}}
                    <!--Grid column-->

                    <!--Grid column-->
                   {{--  <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                        <div class="md-form mb-0">
                           <label for="contact_email" class=" font-weight-bold">Your email <span class="text-danger">*</span></label>
                           <input type="email" id="email" name="contact_email" class="form-control" placeholder="Enter Your Email" value="{{old('contact_email')}}">
                            @error('contact_email')
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror  
                       </div>
                   </div> --}}
                   <!--Grid column-->

                   <!--Grid column-->
                  {{--  <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6 mt-2">
                    <div class="md-form mb-0">
                       <label for="mobile" class=" font-weight-bold">Mobile No <span class="text-danger">*</span></label>
                       <input type="text" id="mobile" name="mobile_no" class="form-control" placeholder="Enter Your Mobile No" value="{{old('mobile_no')}}">
                        @error('mobile_no')
                        <span class="invalid-feedback d-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror 
                   </div>
               </div> --}}
               <!--Grid column-->
               <!--Grid column-->
             {{--   <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 mt-2">
                <div class="md-form mb-0">
                   <label for="subject" class=" font-weight-bold">Subject <span class="text-danger">*</span></label> 
                   <select class="form-control" id="subject" name="subject"  value="{{old('subject')}}" >
                      <option value="0">Select Subject</option>
                       <option value="fran" @if(old('subject')=='fran') selected="selected" @endif>fran</option>
                       <option value="gggg" @if(old('subject')=='gggg') selected="selected" @endif>gggg</option>
                       <option value="cvfgfdg" @if(old('subject')=='cvfgfdg') selected="selected" @endif>cvfgfdg</option>
                   </select>
                    @error('subject')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                  
               </div>
           </div> --}}
           <!--Grid column-->

       {{-- </div> --}}
       <!--Grid row-->
       <!--Grid row-->
      {{--  <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 mt-2">
                 <div class="md-form mb-0">
                   <label for="country" class=" font-weight-bold">Country <span class="text-danger">*</span></label>
                   <select id="country" name="country" class="form-control dynamic" data-dependent="state">
                       <option value='0'>Select Country</option>
                       @foreach($country_list as $countryes)
                             <option value="{{$countryes->country_code}}" {{$countryes->country_code==102 ? 'Selected' :''}}>
                              {{$countryes->country_name}}
                            </option>
                        @endforeach
                   </select> 
                    @error('country')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
               </div>  
           </div>
           <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 mt-2">
             <div class="md-form mb-0">
               <label for="state" class=" font-weight-bold">State <span class="text-danger">*</span></label>
               <select id="state" name="state" class="form-control select-cont" value="">
                   
               </select> 
                @error('state')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
               @enderror 
           </div>  
       </div>
       <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 mt-2">
         <div class="md-form mb-0">
           <label for="city" class=" font-weight-bold">City <span class="text-danger">*</span></label>
           <select id="city" name="city" class="form-control select-cont" value="">
           </select> 
            @error('city')
                  <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
             @enderror 
       </div>  
   </div>
</div>
</div>
</div> --}}
<!--Grid row-->


<!--Grid row-->
{{-- <div class="row">
 --}}
    <!--Grid column-->
{{--     <div class="col-md-12 mt-2">

        <div class="md-form">
            <label for="address" class="font-weight-bold">Your Address </label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Enter Your Address" value="{{ old('address') }}">
              @error('address')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
               @enderror 
        </div>

    </div>
</div> --}}
<!--Grid row-->

{{-- <!--Grid row-->
<div class="row">
    <!--Grid column-->
    <div class="col-md-12 mt-2">

        <div class="md-form">
            <label for="message" class="font-weight-bold">Your message</label>
            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" placeholder="Enter Your Message">{{old('message')}}</textarea>

        </div>

    </div>
</div> --}}
{{-- <br> --}}
<!--Grid row-->
{{-- <div class="row">
 <div class="form-group col-md-4">
    <label for="Captcha"  class="font-weight-bold">Captcha:</label><br>
    <div class="refereshrecapcha">
        <span>{!! captcha_img('flat') !!}</span>   
    </div>                     
</div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" value="{{old('captcha')}}">
    <p>Click Here For <a href="javascript:void(0)" onclick="refreshCaptcha()" class="text-info">Refresh</a> Captch</p>
</div>
<div>
      @error('captcha')
            <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
            </span>
       @enderror   
    </div>
</div> --}}
<!--Grid row-->

<!--Grid row-->
{{-- <div class="text-center text-md-left">
 <button class="btn btn-success" type="submit" id="" name="submit" value="submit"  role="button">Send Details</button>
</div>
</form>
<div class="status"></div>
</div> --}}
<!--Grid column-->

<!--Grid column-->
<div class="col-md-3 text-center">
    <ul class="list-unstyled mb-0">
        <li><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
            <p>Adlaw </p>
        </li>

        <li><i class="fa fa-phone mt-4 fa-2x"></i>
            <p>+ 01 234 567 89</p>
        </li>

        <li><i class="fa fa-envelope mt-4 fa-2x"></i>
            <p>contact@info.adlaw.in</p>
        </li>
    </ul>
</div>
<!--Grid column-->

</div>
</div>


</section>
<script>
// function refreshCaptcha(){
//     $.ajax({
//         type:"GET",
//         url: "",

//         success: function(data) {
        
//         $('.refereshrecapcha').html(data);
//         },
//         error: function(data) {
//         }
//     });
//  }
 $("#country").on('change',function(e){
  e.preventDefault();
  var country_id = $(this).val();

    $.ajax({ 
      type:"GET",
      url:"{{route('state')}}?country_id="+country_id,
      success:function(data)
      {   
          console.log(data);
          if(data.length !=0){
              $("#state").empty();

              $("#state").append('<option value="0">Select State</option>');
              $.each(data,function(k,v){
                  $("#state").append('<option value="'+v.state_code+'">'+v.state_name+'</option>');
              });
          }else{
              $("#state").empty();
              $("#city").empty();
          }
      }
    });
});

  $.ajax({ 
      type:"GET",
      url:"{{route('state')}}?country_id="+102,
      success:function(data)
      {   
          console.log(data);
          if(data.length !=0){
              $("#state").empty();

              $("#state").append('<option value="0">Select State</option>');
              $.each(data,function(k,v){
                  $("#state").append('<option value="'+v.state_code+'">'+v.state_name+'</option>');
              });
          }else{
              $("#state").empty();
              $("#city").empty();
          }
      }
    });

 $("#state").on('change',function(){
    var state_id=$(this).val();
    $.ajax({ 
      type:"GET",
      url:"{{route('city')}}?state_code="+state_id,
      success:function(data)
      {   
          if(data){
          $("#city").empty();
          $("#state").append('<option value="0">Select City</option>');
          $.each(data,function(k,v){
              $("#city").append('<option value="'+v.city_code+'">'+v.city_name+'</option>');
          });
      }else{
          $("#city").empty();
      }

      }
    });
});
</script>

<br>
@endsection
