@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Nav Menu #{{ $navmenu->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/nav-menu') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />

                        {!! Form::model($navmenu, [
                            'method' => 'PATCH',
                            'url' => ['/admin/nav-menu', $navmenu->id],
                            'class' => 'form-horizontal',
                            'files' => true, 
                            'id'=>'add-menu'
                        ]) !!}

                        @include ('admin.nav-menu.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
