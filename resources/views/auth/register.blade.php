@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if($message = Session::get('Error'))
                            <div class="alert alert-danger">
                               {{$message}}
                            </div>
                        @endif
                         <div class="form-group row">
                            <label for="user_category" class="col-md-4 col-form-label text-md-right">User Category</label>

                            <div class="col-md-6">
                               <select name="user_category" class="form-control" id="user_category"  > 
                                <option value="0">Select User Type</option>
                                @foreach($user_catgs as $user_catg)
                                    <option value="{{ $user_catg->id}}" {{old('user_category')== $user_catg->id ? 'selected' : ''}}>{{ $user_catg->display_name}}</option>
                                    @endforeach
                               </select>

                                @error('user_category')
                                    <span style="color:#e3342f; font-size: 80%;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                       {{--  <div class="form-group row" style="display: none;" id="mobileDiv">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number')}}</label>
                            <div class="col-md-6"> 
                                <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}">
                            </div>

                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row" style="display: none" id="genderDiv">
                             <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender')}}</label>
                             <div class="col-md-6">
                                  <select name="gender" class="form-control">
                                      <option value="0">Select Gender</option>
                                      <option value='m'>Male</option>
                                      <option value='f'>Female</option>
                                      <option value='t'>Other</option>
                                  </select>

                             </div>
                             @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row" style="display: none" id="dateDiv">
                        
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                            <div class="col-md-6">

                            <input type="date" value="{{old('dob')}}" class="form-control border border-secondary" name="dob">

                            @error('dob')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group row" style="display: none" id="stateDiv">
                            <input type="hidden" name="country_code" value="102">
                             <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                                
                                <select class="form-control" name="state_code" id="state">
                                    <option value="0"> Select state</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state->state_code }}">{{ $state->state_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             @error('state_code')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group row" style="display: none" id="cityDiv">
                             <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="city_code" id="city">
                                    
                                </select>
                            </div>
                             @error('city_code')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
      $('#user_category').on('change',function(){
           var user_category = $(this).val();
           console.log(user_category);
           if(user_category == 5){
                $('#mobileDiv').show();
                $('#genderDiv').show();
                $('#dateDiv').show();
                $('#stateDiv').show();
                $('#cityDiv').show();
           }  
           if(user_category==0 || user_category == 2 || user_category==3 || user_category == 4)    {
              $('#mobileDiv').hide();
                $('#genderDiv').hide();
                $('#dateDiv').hide();
                $('#stateDiv').hide();
                $('#cityDiv').hide();
           }
        });


      $('#state').on('change',function(){
                    var state_code = $(this).val(); 
                   
                    if(state_code){
                        $.ajax({
                            type:"GET",
                            url:"{{ route('city') }}?state_code="+state_code,
                            success:function(res){               
                                if(res){
                                $("#city").empty();
                                $("#city").append('<option value="0">Select City</option>');
                                $.each(res,function(index, cityObj){
                                $("#city").append('<option value="'+cityObj.city_code+'">'+cityObj.city_name+'</option>');
                        });

                                }
                                else{
                                $("#city").empty();
                                }
                            }
                        });
                    }
                    else{
                    $("#city").empty();
                    }

                });


    });
</script>
@endsection
