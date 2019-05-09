@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit NewsCategory #{{ $newscategory->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/news-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />                        

                        {!! Form::model($newscategory, [
                            'method' => 'PATCH',
                            'url' => ['/admin/news-category', $newscategory->id],
                            'class' => 'form-horizontal',
                            'files' => true, 
                            'id'=>'news-category'
                        ]) !!}

                        @include ('admin.news-category.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
