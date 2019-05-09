@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-12">
                @include('alert-message') 
                <div class="card">
                    <div class="card-header">Pages</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/pages/create') }}" class="btn btn-success btn-sm" title="Add New page">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/pages', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                        <th>S.No</th><th>Title</th><th>Content</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($pages as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ !empty($item->pagesTranslate->title) ? $item->pagesTranslate->title : '-' }}</td>
                                        <td>{!! !empty($item->pagesTranslate->content) ? str_limit($item->pagesTranslate->content, $limit = 100, $end = '...') : '-' !!}</td>
                                        <td>
                                            <a href="{{ url('/admin/pages/' . $item->id) }}" title="View page"><button class="btn btn-info btn-sm"><i class="far fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/pages/' . $item->id . '/edit') }}" title="Edit page"><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/pages', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="far fa-trash-alt"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete page',
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
                            <div class="pagination-wrapper"> {{ $pages->links() }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
