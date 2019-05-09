<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="control-label">{{ 'Category' }}</label>
    {{ Form::select('category', $arrDealerCategory, null, ['class'=>'form-control']) }}
    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Title*</h3>
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
                        {{ Form::textarea("title[]", !empty($dealer->dealerAllTranslate[$loop->index]->title) ? $dealer->dealerAllTranslate[$loop->index]->title : '', ['class'=>'form-control summernote', 'rows'=>2, 'required']) }}

                        @if (!empty($errors->first("title")))
                           {!! $errors->first("title", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("title.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   
                    </div>
                @endforeach
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>


<div class="form-group {{ $errors->has('address_1') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Address*</h3>
          <ul class="nav nav-pills ml-auto p-2">
            @foreach ($language as $code=>$lang)
                <li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#address_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                @foreach ($language as $code=>$lang)
                    <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="address_{{$loop->index}}">
                        {!! Form::label('address_1', 'Address 1*', ['class' => 'control-label']) !!}
                        {{ Form::textarea("address_1[]", !empty($dealer->dealerAllTranslate[$loop->index]->address_1) ? $dealer->dealerAllTranslate[$loop->index]->address_1 : '', ['class'=>'form-control summernote', 'rows'=>2, 'required']) }}
                        @if (!empty($errors->first("address_1")))
                           {!! $errors->first("address_1", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("address_1.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   

                        <br>
                        {!! Form::label('address_2', 'Address 2', ['class' => 'control-label']) !!}
                        {{ Form::textarea("address_2[]", !empty($dealer->dealerAllTranslate[$loop->index]->address_2) ? $dealer->dealerAllTranslate[$loop->index]->address_2 : '', ['class'=>'form-control summernote', 'rows'=>2]) }}

                        @if (!empty($errors->first("address_2")))
                           {!! $errors->first("address_2", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("address_2.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif


                    </div>
                @endforeach
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    {!! Form::label('city', 'City*', ['class' => 'control-label']) !!}
    {!! Form::text('city', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    {!! Form::label('state', 'State*', ['class' => 'control-label']) !!}
    {!! Form::text('state', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('postal_code') ? 'has-error' : ''}}">
    {!! Form::label('postal_code', 'Postal Code*', ['class' => 'control-label']) !!}
    {!! Form::text('postal_code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('postal_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
    {!! Form::label('country', 'Country*', ['class' => 'control-label']) !!}
    {!! Form::text('country', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('latitude') ? 'has-error' : ''}}">
    {!! Form::label('latitude', 'Latitude*', ['class' => 'control-label']) !!}
    {!! Form::text('latitude', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('longitude') ? 'has-error' : ''}}">
    {!! Form::label('longitude', 'Longitude*', ['class' => 'control-label']) !!}
    {!! Form::text('longitude', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Phone*', ['class' => 'control-label']) !!}
    {!! Form::number('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fax') ? 'has-error' : ''}}">
    {!! Form::label('fax', 'Fax', ['class' => 'control-label']) !!}
    {!! Form::text('fax', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('fax', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    {!! Form::label('link', 'Link', ['class' => 'control-label']) !!}
    {!! Form::text('link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    {{ Form::select('status', ['1'=>'Active', '0'=>'Deactive'], null, ['class'=>'form-control']) }}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
