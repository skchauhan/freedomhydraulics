@extends('layouts.admin')

@section('content')
    <div class="container">
    <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New User</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        
                        {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal', 'id'=>'user-register', 'files' => true]) !!}

                        @include ('admin.users.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
