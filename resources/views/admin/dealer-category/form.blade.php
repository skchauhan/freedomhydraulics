<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Name*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#alt_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                @foreach ($language as $code=>$lang)
                    {{ Form::hidden('language_code[]', $code) }}
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="alt_{{$loop->index}}">
                        {{ Form::text("name[]", !empty($dealercategory->dealerCategoryAllTranslate[$loop->index]->name) ? $dealercategory->dealerCategoryAllTranslate[$loop->index]->name : '', ['class'=>'form-control summernote', 'rows'=>2, 'required']) }}
                        
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

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    {{ Form::select('status', ['1'=>'Active', '0'=>'Deactive'], null, ['class'=>'form-control']) }}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
