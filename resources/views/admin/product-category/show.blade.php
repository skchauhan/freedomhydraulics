@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Category {{ $productcategory->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/product-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/product-category/' . $productcategory->id . '/edit') }}" title="Edit ProductCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/productcategory', $productcategory->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete ProductCategory',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $productcategory->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th><td>{{ !empty($productcategory->categoryTranslate->name) ? $productcategory->categoryTranslate->name : '-' }}</td>
                                    </tr>
                                    <tr><th> Parent Category </th><td> {{ !empty($productcategory->parentCategory->name) ? $productcategory->parentCategory->name : '-' }} </td></tr>
                                    <tr><th> Category Order </th><td> {{ $productcategory->category_order }} </td></tr>
                                    <tr><th> Image </th><td> 
                                         @isset ($productcategory->image)                           
                                                @if ( file_exists('public/product/'.$productcategory->image) )
                                                    <img src="{{ asset('public/product/'.$productcategory->image) }}" width="150px">
                                                @endif 
                                            @endisset
                                    </td></tr>

                                    <tr><th>Meta Keywords</th><td>{{ !empty($productcategory->categoryTranslate->meta_keywords) ? $productcategory->categoryTranslate->meta_keywords :  '-' }}</td></tr>

                                    <tr><th>Meta Description</th><td>{{ !empty($productcategory->categoryTranslate->meta_description) ? $productcategory->categoryTranslate->meta_description :  '-' }}</td></tr>
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
