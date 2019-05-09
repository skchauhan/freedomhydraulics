<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    {!! Form::label('parent_id', 'Parent Category', ['class' => 'control-label']) !!}
    {!! Form::select('parent_id', $arrCategory, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Name*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
            {{ Form::hidden('language_code[]', $code) }}
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#name_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="name_{{$loop->index}}">
                        {{ Form::textarea("name[]", !empty($newscategory->categoryAllTranslate[$loop->index]->name) ? $newscategory->categoryAllTranslate[$loop->index]->name : '', ['class'=>'form-control summernote', 'rows'=>2]) }}

                        @if (!empty($errors->first("name")))
                           {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("name.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   
                    </div>
                @endforeach
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
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
                        {{ Form::textarea("meta_keywords[]", !empty($newscategory->categoryAllTranslate[$loop->index]->meta_keywords) ? $newscategory->categoryAllTranslate[$loop->index]->meta_keywords : '', ['class'=>'form-control summernote', 'rows'=>2]) }}
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
                        {{ Form::textarea("meta_description[]", !empty($newscategory->categoryAllTranslate[$loop->index]->meta_description) ? $newscategory->categoryAllTranslate[$loop->index]->meta_description : '', ['class'=>'form-control summernote', 'rows'=>2]) }}

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

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
