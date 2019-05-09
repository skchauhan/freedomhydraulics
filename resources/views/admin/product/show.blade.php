@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Product {{ $product->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/products') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/products', $product->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Product',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr><th>ID</th><td>{{ $product->id }}</td></tr>
                                    <tr><th> Category </th><td> {{ !empty($product->productCategory->name) ? $product->productCategory->name : '-' }} </td></tr>

                                    <tr><th>Name</th><td>{{ !empty($product->productTranslate->name) ? $product->productTranslate->name : '-' }}</td></tr>
                                    
                                    <tr><th colspan="2">Sliders</th></tr>
                                    @php $k = 0; @endphp
                                    @forelse ($product->sliders as $slider)
                                        <tr>
                                            <th>Image</th>
                                            <td>
                                                @isset ($slider->image)                           
                                                    @if ( file_exists('public/product/'.$slider->image) )
                                                        <img src="{{ asset('public/product/'.$slider->image) }}" width="100px">
                                                    @endif 
                                                @endisset
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Content</th>
                                            <td>
                                                {{ !empty($product->sliders[$k]->sliderTranslate->first()->description) ? $product->sliders[$k]->sliderTranslate->first()->description : '-' }}
                                            </td>
                                        </tr>
                                        @php ++$k; @endphp
                                    @empty          
                                    @endforelse

                                    <tr><th>Meta Keywords</th><td>{{ !empty($product->productTranslate->meta_keywords) ? $product->productTranslate->meta_keywords : '-' }}</td></tr>

                                    <tr><th>Meta Description</th><td>{{ !empty($product->productTranslate->meta_description) ? $product->productTranslate->meta_description : '-' }}</td></tr>

                                    <tr><th>Status</th><td>
                                        @if ($product->status == 0)
                                            {{ 'Deactive' }}
                                        @else
                                            {{ 'Active' }}
                                        @endif
                                    </td></tr>
                                </tbody>
                            </table>                            
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
