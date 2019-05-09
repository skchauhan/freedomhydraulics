@extends('layouts.app')

@section('content')
    <div class="login-box">
      <div class="login-logo">
        Freedom Hydraulics
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group mb-3">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
              <div class="input-group-append">
                  <span class="fa fa-envelope input-group-text"></span>
              </div>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">             
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary"> {{ __('Send Password Reset Link') }} </button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          
          <p class="mb-0">
            <a href="{{ url('/register') }}" class="text-center">Register a new membership</a><br>
            <a href="{{ url('/login') }}" class="text-center">Login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
@endsection
