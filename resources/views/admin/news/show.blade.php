@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">News {{ $news->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/news') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/news/' . $news->id . '/edit') }}" title="Edit News"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/news' . '/' . $news->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete News" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr><th>ID</th><td>{{ $news->id }}</td></tr>
                                    <tr>
                                        <th> Image </th>
                                        <td> 
                                            @isset ($news->image)                           
                                                @if ( file_exists('public/news/'.$news->image) )
                                                    <img src="{{ asset('public/news/'.$news->image) }}" width="150px">
                                                @endif 
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Title </th>
                                        <td> {{ !empty($news->newsTranslate->title) ? $news->newsTranslate->title : '-' }} </td>
                                    </tr>
                                    <tr>
                                        <th> Content </th>
                                        <td> {!! !empty($news->newsTranslate->content) ? $news->newsTranslate->content : '-' !!} </td>
                                    </tr>
                                    <tr><th>Category</th><td>{{ !empty($news->newsCategory->name) ? $news->newsCategory->name :  '-' }}</td></tr>

                                    <tr><th>Meta Keywords</th><td>{{ !empty($news->newsTranslate->meta_keywords) ? $news->newsTranslate->meta_keywords :  '-' }}</td></tr>

                                    <tr><th>Meta Description</th><td>{{ !empty($news->newsTranslate->meta_description) ? $news->newsTranslate->meta_description :  '-' }}</td></tr>

                                    <tr><th>Image Alt</th><td>{{ !empty($news->newsTranslate->image_alt) ? $news->newsTranslate->image_alt :  '-' }}</td></tr>

                                    <tr><th>Author</th><td>{{ !empty($news->newsAuthor->name) ? $news->newsAuthor->name : '-' }}</td></tr>
                                    <tr><th>Status</th><td>
                                        @if ($news->status == 0)
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
