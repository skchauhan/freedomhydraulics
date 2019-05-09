@extends('layouts.admin')

@section('content')
    <div class="container">
        <br/>
        <div class="row">
            <div class="col-md-12">
                @include('alert-message')
                <div class="card">
                    <div class="card-header">General Settings</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/general-settings/create') }}" class="btn btn-success btn-sm" title="Add New generalSetting">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/general-settings', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                            {!! Form::open(['url' => '/admin/update-setting', 'class' => 'form-horizontal', 'files' => true]) !!}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th><th>Key</th><th>Value</th><th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 0; @endphp
                                @foreach($generalsettings as $item)

                                    @if ($item->key != "logo")
                                    
                                        <tr class="row-setting">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ ucfirst($item->key) }}</td>
                                            <td>
                                                {{ Form::hidden('key[]', $item->key) }}
                                                {{ Form::hidden('id[]', $item->id) }}       
                                                {{ Form::text('value[]', $item->value, ['class'=>'form-control']) }} 
                                            </td>                                          
                                            <td>
                                                <a class="delete_setting btn btn-danger btn-sm" data-id="{{ $item->id }}">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                    @endif

                                @endforeach
                                </tbody>
                            </table>

                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

                            {{ Form::close() }}
                            
                        </div>
                        <br>

                        {{ Form::open(['url'=>'/admin/upload-logo', 'class' => 'form-horizontal', 'files' => true ]) }}
                        <table class="table">
                            <tr>
                                <td>
                                    <label for="user_role" class="control-label">Site Logo</label>
                                </td>

                                <td>
                                    {{ Form::file('logo', ['class'=>'form-control', 'required']) }}
                                    {{ Form::hidden('id', $site_logo_id, ['class'=>'form-control']) }}
                                </td>
                                <td>
                                    {{ Form::submit('Upload', ['class'=>'btn btn-primary']) }}
                                </td>
                                <td>
                                    @php
                                        $site_logo = \App\GeneralSetting::find($site_logo_id)->value;
                                        
                                        $site_url = url('public/images/'.$site_logo);

                                        if(file_exists(public_path('images/'.$site_logo))) {
                                    @endphp
                                        <img src="{{ $site_url }}" width="100px">
                                    @php        
                                        }
                                    @endphp
                                </td>
                            </tr>
                        </table>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection