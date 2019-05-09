@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-12">
                @include('alert-message') 
                <div class="card">
                    <div class="card-header">Product tab</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/product-tab/create') }}" class="btn btn-success btn-sm" title="Add New ProductTab">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/product-tab', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th><th>Name</th><th>Status</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($producttab as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ !empty($item->tabTranslate->name) ? $item->tabTranslate->name : '-' }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ url('/admin/product-tab/' . $item->id . '/edit') }}" title="Edit ProductTab"><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/product-tab', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="far fa-trash-alt"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete ProductTab',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"> <strong>No Records Found!</strong> </td>
                                        </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $producttab->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
