@extends('layouts.admin')

@section('content')
    <div class="container">
        <br/>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit generalSetting #{{ $generalsetting->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/general-settings') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($generalsetting, [
                            'method' => 'PATCH',
                            'url' => ['/admin/general-settings', $generalsetting->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.general-settings.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
