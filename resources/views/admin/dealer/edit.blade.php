@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Dealer #{{ $dealer->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/dealer') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />

                        {!! Form::model($dealer, [
                            'method' => 'PATCH',
                            'url' => ['/admin/dealer', $dealer->id],
                            'class' => 'form-horizontal',
                            'files' => true,
                            'id'=>'add-dealer'
                        ]) !!}

                        @include ('admin.dealer.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
