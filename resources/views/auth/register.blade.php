@extends('layouts.app')

@section('content')

    <div class="register-box">
      <div class="register-logo">
        Freedom Hydraulics
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Register a new membership</p>

          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group mb-3">
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required placeholder="Full name">
              <div class="input-group-append">
                  <span class="fa fa-user input-group-text"></span>
              </div>
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>

            <div class="input-group mb-3">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required  placeholder="Email">
              <div class="input-group-append">
                  <span class="fa fa-envelope input-group-text"></span>
              </div>
              @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
              @endif
            </div>

            <div class="input-group mb-3">
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="Password">

              <div class="input-group-append">
                  <span class="fa fa-lock input-group-text"></span>
              </div>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="input-group mb-3">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
              <div class="input-group-append">
                  <span class="fa fa-lock input-group-text"></span>
              </div>
            </div>
            <div class="row">              
              <!-- /.col -->
              <div class="col-4">
                <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button> -->
                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
              </div>
              <!-- /.col -->
            </div>
          </form>         

          <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
            
@endsection
