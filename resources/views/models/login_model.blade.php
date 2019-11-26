<div class="modal fade login_modal"  tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
   
      <div class="modal-body">
        <h5 class="text-center">
          <a class="navbar-brand p-2" href="{{url('/')}}"><img src="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" style="width: 120px;"></a>
        </h5>
         <form method="POST" action="{{ route('login') }}" id="formLogin">
              @csrf
          <div class="form-group">
            <label for="email" class="col-form-label">Email address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
          </div>
          <div class="form-group mb-0">
            <label for="password" class="col-form-label">Password </label>
             <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>
          <div class="">            
              @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
               @endif
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <a href="{{url('/register')}}"  class="btn  btn-info" >Signup</a>
      </div>
    </div>
  </div>
</div>