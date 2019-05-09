<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    <label for="parent_id" class="control-label">{{ 'Parent category' }}</label>
    {{ Form::select('parent_id', $arrCategory, null, ['class'=>'form-control']) }}
    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Name*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                {{ Form::hidden('language_code[]', $code) }}
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#spec_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">                
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="spec_{{$loop->index}}">
                        {{ Form::text('name[]', !empty($productcategory->categoryAllTranslate[$loop->index]->name) ? $productcategory->categoryAllTranslate[$loop->index]->name : '', ['class'=>'form-control summernote']) }}

                        @if (!empty($errors->first("name")))
                           {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("name.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif                    
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image*', ['class' => 'control-label']) !!}
    {!! Form::file('image',  ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('img_alt') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Image Alt*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#alt_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="alt_{{$loop->index}}">
                        {{ Form::textarea("img_alt[]", !empty($news->newsAllTranslate[$loop->index]->image_alt) ? $news->newsAllTranslate[$loop->index]->image_alt : '', ['class'=>'form-control summernote', 'rows'=>2]) }}

                        @if (!empty($errors->first("img_alt")))
                           {!! $errors->first("img_alt", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("img_alt.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('category_order') ? 'has-error' : ''}}">
    {!! Form::label('category_order', 'Category Order*', ['class' => 'control-label']) !!}
    {!! Form::number('category_order', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('category_order', '<p class="help-block">:message</p>') !!}
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
                        {{ Form::textarea("meta_keywords[]", !empty($news->newsAllTranslate[$loop->index]->meta_keywords) ? $news->newsAllTranslate[$loop->index]->meta_keywords : '', ['class'=>'form-control summernote', 'rows'=>2]) }}
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
                        {{ Form::textarea("meta_description[]", !empty($news->newsAllTranslate[$loop->index]->meta_description) ? $news->newsAllTranslate[$loop->index]->meta_description : '', ['class'=>'form-control summernote', 'rows'=>2]) }}

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
