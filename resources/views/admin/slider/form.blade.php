<div class="form-group {{ $errors->has('slider_text') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Slider Text*</h3>
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
                        {{ Form::text('slider_text[]', !empty($slider->sliderAllTranslate[$loop->index]->slider_text) ? $slider->sliderAllTranslate[$loop->index]->slider_text : '', ['class'=>'form-control summernote', 'required']) }}

                        @if (!empty($errors->first("slider_text")))
                           {!! $errors->first("slider_text", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("slider_text.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif                    
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image*', ['class' => 'control-label']) !!}
    {!! Form::file('image', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

@isset ($slider->image)
    @if ( file_exists('public/sliders/'.$slider->image) )
        <img src="{{ asset('public/sliders/'.$slider->image) }}" width="100px">
    @endif
@endisset

<div class="form-group">
    <br>
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
