@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Dealer {{ $dealer->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/dealer') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/dealer/' . $dealer->id . '/edit') }}" title="Edit Dealer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/dealer', $dealer->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Dealer',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $dealer->id }}</td>
                                    </tr>
                                    <tr><th> Category </th><td> {{ !empty($dealer->dealerCategory->name) ? $dealer->dealerCategory->name : '' }} </td></tr>
                                    <tr><th> Title </th><td> {{ !empty($dealer->dealerTranslate->title) ? $dealer->dealerTranslate->title : '-' }} </td></tr>
                                    <tr><th> Address 1 </th><td> {{ !empty($dealer->dealerTranslate->address_1) ? $dealer->dealerTranslate->address_1 : '-' }} </td>
                                    </tr>
                                    <tr><th> Address 2 </th><td> {{ !empty($dealer->dealerTranslate->address_2) ? $dealer->dealerTranslate->address_2 : '-' }} </td>
                                    </tr>
                                    <tr><th> City </th><td> {{ !empty($dealer->city) ? $dealer->city : '-' }} </td></tr>
                                    <tr><th> State </th><td> {{ !empty($dealer->state) ? $dealer->state : '-' }} </td></tr>
                                    <tr><th> Postal Code </th><td> {{ !empty($dealer->postal_code) ? $dealer->postal_code : '-' }} </td></tr>
                                    <tr><th> Country </th><td> {{ !empty($dealer->country) ? $dealer->country : '-' }} </td></tr>
                                    <tr><th> Latitude </th><td> {{ !empty($dealer->latitude) ? $dealer->latitude : '-' }} </td></tr>
                                    <tr><th> Longitude </th><td> {{ !empty($dealer->longitude) ? $dealer->longitude : '-' }} </td></tr>
                                    <tr><th> Phone </th><td> {{ !empty($dealer->phone) ? $dealer->phone : '-' }} </td></tr>
                                    <tr><th> Fax </th><td> {{ !empty($dealer->fax) ? $dealer->fax : '-' }} </td></tr>
                                    <tr><th> Status </th><td> {{ !empty($dealer->status) ? $dealer->status : '-' }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
