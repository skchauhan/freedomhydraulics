@extends('layouts.admin')

@section('content')
    <div class="container">
    <br>
        <div class="row">

            <div class="col-md-9">
                
                @include('alert-message')

                <div class="card">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">

                        {{ Form::open(array('url' => '/admin/change-password', 'files' => true)) }}

                            {{ Form::hidden('user_id', Auth::user()->id ) }}

                            <div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
                                {!! Form::label('old_password', 'Old Password', ['class' => 'control-label']) !!}
                                {!! Form::password('old_password', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                                {!! Form::password('password', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                                {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'control-label']) !!}
                                {!! Form::password('password_confirmation', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>

                        {{ Form::close() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

