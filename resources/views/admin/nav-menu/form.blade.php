<div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
    {!! Form::label('order', 'Order*', ['class' => 'control-label']) !!}
    {!! Form::number('order', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Menu*</h3>
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
                        {{ Form::text('menu['.$loop->index.']', !empty($navmenu->navMenusAllTranslate[$loop->index]->menu) ? $navmenu->navMenusAllTranslate[$loop->index]->menu : '', ['class'=>'form-control summernote', 'required']) }}

                        @if (!empty($errors->first("menu")))
                           {!! $errors->first("menu", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("menu.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif                    
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug', 'Slug*', ['class' => 'control-label']) !!}
    {!! Form::text('slug', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    {!! Form::select('status', ['1' => 'active', '0' => 'deactive'], !empty($navmenu) ? $navmenu->status : '', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
