@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit language #{{ $language->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/languages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />

                        {!! Form::model($language, [
                            'method' => 'PATCH',
                            'url' => ['/admin/languages', $language->id],
                            'class' => 'form-horizontal',
                            'files' => true,
                            'id'=>'add-language'
                        ]) !!}

                        @include ('admin.languages.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
