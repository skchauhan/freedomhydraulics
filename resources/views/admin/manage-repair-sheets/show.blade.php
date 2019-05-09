@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Manage Repair Sheet {{ $managerepairsheet->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/manage-repair-sheets') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/manage-repair-sheets/' . $managerepairsheet->id . '/edit') }}" title="Edit ManageRepairSheet"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/managerepairsheets', $managerepairsheet->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete ManageRepairSheet',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $managerepairsheet->id }}</td>
                                    </tr>
                                    <tr><th> Category </th><td> {{ $managerepairsheet->category }} </td></tr>
                                    <tr><th> Modal Name </th><td> {{ $managerepairsheet->modal_name }} </td></tr>
                                    <tr><th> Description </th><td> {{ $managerepairsheet->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
