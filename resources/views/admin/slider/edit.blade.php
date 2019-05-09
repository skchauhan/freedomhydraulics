@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Slider #{{ $slider->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/slider') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />

                        {!! Form::model($slider, [
                            'method' => 'PATCH',
                            'url' => ['/admin/slider', $slider->id],
                            'class' => 'form-horizontal',
                            'files' => true,
                            'id' => 'update-slider'
                        ]) !!}

                        @include ('admin.slider.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
