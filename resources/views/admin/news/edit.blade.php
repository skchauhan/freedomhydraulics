@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
        <br>
                <div class="card">
                    <div class="card-header">Edit News #{{ $news->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/news') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        {!! Form::model($news, [
                            'method' => 'PATCH',
                            'url' => ['/admin/news', $news->id],
                            'class' => 'form-horizontal',
                            'files' => true,
                            'id' => 'news-update'
                        ]) !!}

                            @include ('admin.news.form', ['formMode' => 'edit'])

                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
