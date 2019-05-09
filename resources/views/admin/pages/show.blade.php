@extends('layouts.admin')

@section('content')
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">page {{ $page->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/pages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/pages/' . $page->id . '/edit') }}" title="Edit page"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/pages', $page->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete page',
                            'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr><th>ID</th>
                                        <td>{{ $page->id }}</td>
                                    </tr>
                                    <tr><th> Title </th>
                                        <td> {{ !empty($page->pagesTranslate->title) ? $page->pagesTranslate->title : '-' }} </td>
                                    </tr>
                                    <tr><th> Content </th>
                                        <td> {!! !empty($page->pagesTranslate->content) ? $page->pagesTranslate->content : '-' !!} </td>
                                    </tr>
                                    <tr><th> Meta keywords </th>
                                        <td> {!! !empty($page->pagesTranslate->meta_keywords) ? $page->pagesTranslate->meta_keywords : '-' !!} </td>
                                    </tr>
                                    <tr><th> Meta Description </th>
                                        <td> {!! !empty($page->pagesTranslate->meta_description) ? $page->pagesTranslate->meta_description : '-' !!} </td>
                                    </tr>
                                    <tr><th>Status</th><td>
                                        @if ($page->status == 0)
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
