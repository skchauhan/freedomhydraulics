@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Category</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/product-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />

                        {!! Form::open(['url' => '/admin/product-category', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.product-category.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
