@extends('layouts.admin')

@section('content')

    <div class="container">
       <br>
        <div class="row">
            <div class="col-md-12">
                @include('alert-message') 
                <div class="card">
                    <div class="card-header">News</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/news/create') }}" class="btn btn-success btn-sm" title="Add New News">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <form method="GET" action="{{ url('/admin/news') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th><th>Category</th><th>Title</th><th>Content</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($news as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ !empty($item->newsCategory->name) ? $item->newsCategory->name :  '-' }}</td>
                                        <td>{{ !empty($item->newsTranslate->title) ? $item->newsTranslate->title : '-' }}</td>
                                        <td>{!! !empty($item->newsTranslate->content) ?  str_limit($item->newsTranslate->content, $limit = 100, $end = '...') : '' !!}</td>
                                        <td>
                                            <a href="{{ url('/admin/news/' . $item->id) }}" title="View News"><button class="btn btn-info btn-sm"><i class="far fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/news/' . $item->id . '/edit') }}" title="Edit News"><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/news' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete News" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="far fa-trash-alt"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"> <strong>No Records Found!</strong> </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> 
                                @if (!empty($news))
                                    {!! $news->links() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
