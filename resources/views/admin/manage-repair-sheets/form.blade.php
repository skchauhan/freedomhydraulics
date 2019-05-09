<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    {!! Form::label('category', 'Category', ['class' => 'control-label']) !!}
    {!! Form::text('category', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('modal_name') ? 'has-error' : ''}}">
    {!! Form::label('modal_name', 'Modal Name', ['class' => 'control-label']) !!}
    {!! Form::text('modal_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('modal_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows'=>2] : ['class' => 'form-control', 'rows'=>2]) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<a class="add_more"> <i class="fas fa-plus-square"></i> Add More</a>
<div id="repair_sheet_list">
    <div class="sheets">
        <div class="form-group {{ $errors->has('repair_sheet') ? 'has-error' : ''}}">
            {!! Form::label('repair_sheet', 'Repair sheet', ['class' => 'control-label']) !!}
            {!! Form::file('repair_sheet[]', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('repair_sheet', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('repair_sheet_caption') ? 'has-error' : ''}}">
            {!! Form::label('repair_sheet_caption', 'Repair Sheet Caption', ['class' => 'control-label']) !!}
            {!! Form::text('repair_sheet_caption[]', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('repair_sheet_caption', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('instruction') ? 'has-error' : ''}}">
    {!! Form::label('instruction', 'Instruction', ['class' => 'control-label']) !!}
    {!! Form::file('instruction', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('instruction', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('instruction_caption') ? 'has-error' : ''}}">
    {!! Form::label('instruction_caption', 'Instruction Caption', ['class' => 'control-label']) !!}
    {!! Form::text('instruction_caption', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('instruction_caption', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cad') ? 'has-error' : ''}}">
    {!! Form::label('cad', 'Cad', ['class' => 'control-label']) !!}
    {!! Form::text('cad', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('cad', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('enerpac') ? 'has-error' : ''}}">
    {!! Form::label('enerpac', 'Enerpac', ['class' => 'control-label']) !!}
    {!! Form::text('enerpac', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('enerpac', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('simplex') ? 'has-error' : ''}}">
    {!! Form::label('simplex', 'Simplex', ['class' => 'control-label']) !!}
    {!! Form::text('simplex', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('simplex', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('power_team') ? 'has-error' : ''}}">
    {!! Form::label('power_team', 'Power Team', ['class' => 'control-label']) !!}
    {!! Form::text('power_team', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('power_team', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('williams') ? 'has-error' : ''}}">
    {!! Form::label('williams', 'Williams', ['class' => 'control-label']) !!}
    {!! Form::text('williams', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('williams', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ram-pac') ? 'has-error' : ''}}">
    {!! Form::label('ram-pac', 'Ram pac', ['class' => 'control-label']) !!}
    {!! Form::text('ram-pac', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('ram-pac', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bva') ? 'has-error' : ''}}">
    {!! Form::label('bva', 'Bva', ['class' => 'control-label']) !!}
    {!! Form::text('bva', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('bva', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
