@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-12">
                @include('alert-message') 
                <div class="card">
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/product-category/create') }}" class="btn btn-success btn-sm" title="Add New ProductCategory">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/product-category', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                        <th>S.No</th><th>Parent Category</th><th>Name</th><th>Category Order</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($productcategory as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ !empty($item->parentCategory->name) ? $item->parentCategory->name : '-' }}</td>
                                        <td>{{ !empty($item->categoryTranslate->name) ? $item->categoryTranslate->name : '-' }}</td>
                                        
                                        <td>{{ $item->category_order }}</td>
                                        <td>
                                            <a href="{{ url('/admin/product-category/' . $item->id) }}" title="View ProductCategory"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/product-category/' . $item->id . '/edit') }}" title="Edit ProductCategory"><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/product-category', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="far fa-trash-alt"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete ProductCategory',
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
                            <div class="pagination-wrapper"> {!! $productcategory->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
