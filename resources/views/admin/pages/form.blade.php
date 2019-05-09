<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Title*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                {{ Form::hidden('language_code[]', $code) }}
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#title_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">                
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="title_{{$loop->index}}">
                        {{ Form::text('title[]', !empty($page->pagesAllTranslate[$loop->index]->title) ? $page->pagesAllTranslate[$loop->index]->title : null, ['class'=>'form-control summernote']) }}

                        @if (!empty($errors->first("title")))
                           {!! $errors->first("title", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("title.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif                    
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Content*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#cont_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">                
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="cont_{{$loop->index}}">
                    	{{ Form::textarea("content[]", !empty($page->pagesAllTranslate[$loop->index]->content) ? $page->pagesAllTranslate[$loop->index]->content : null, ['class'=>'form-control summernote editor', 'rows'=>4, 'id'=>"content_$loop->iteration"]) }}

                        @if (!empty($errors->first("content")))
                           {!! $errors->first("content", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("content.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif                    
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('meta_keywords') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Meta Keywords*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#keywords_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="keywords_{{$loop->index}}">
                        {{ Form::textarea("meta_keywords[]", !empty($page->pagesAllTranslate[$loop->index]->meta_keywords) ? $page->pagesAllTranslate[$loop->index]->meta_keywords : '', ['class'=>'form-control summernote', 'rows'=>2]) }}
                        @if (!empty($errors->first("meta_keywords")))
                           {!! $errors->first("meta_keywords", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("meta_keywords.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   
                    </div>
                @endforeach
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Meta Description*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#descpt_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="descpt_{{$loop->index}}">
                        {{ Form::textarea("meta_description[]", !empty($page->pagesAllTranslate[$loop->index]->meta_description) ? $page->pagesAllTranslate[$loop->index]->meta_description : '', ['class'=>'form-control summernote', 'rows'=>2]) }}

                        @if (!empty($errors->first("meta_description")))
                           {!! $errors->first("meta_description", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("meta_description.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   
                    </div>
                @endforeach
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    {{ Form::select('status', ['1'=>'Active', '0'=>'Deactive'], null, ['class'=>'form-control']) }}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
