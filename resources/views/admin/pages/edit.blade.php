@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit page #{{ $page->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/pages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />

                        {!! Form::model($page, [
                            'method' => 'PATCH',
                            'url' => ['/admin/pages', $page->id],
                            'class' => 'form-horizontal',
                            'files' => true, 
                            'id'=>'add-page'
                        ]) !!}

                        @include ('admin.pages.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
