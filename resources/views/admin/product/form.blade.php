<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Category*', ['class' => 'control-label']) !!}
    {!! Form::select('category_id', $arrCategory, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
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
                        {{ Form::text('name[]', !empty($product->productAllTranslate[$loop->index]->name) ? $product->productAllTranslate[$loop->index]->name : '', ['class'=>'form-control summernote']) }}

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

<a class="add_more"> <i class="fas fa-plus-square"></i> Add More</a>
<div class="product_slider">
	@php $jk = 0; @endphp
	

	{{-- {{ pre($product->sliders) }} --}}
@if (!empty($product))
    @forelse ($product->sliders as $slider)
		<div class="slider">
			@if ($jk != 0)
				<a class="remove_slider"> <i class="fas fa-window-close"></i> Remove</a>
			@endif	

			<div class="form-group {{ $errors->has('slider_image') ? 'has-error' : ''}}">
			    {!! Form::label('slider_image', 'Slider Image', ['class' => 'control-label']) !!}
			    {!! Form::file("slider_image[$jk]", ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
			    {!! $errors->first('slider_image', '<p class="help-block">:message</p>') !!}
			</div>

			@isset ($slider->image)
		        @if ( file_exists('public/product/'.$slider->image) )
		            <img src="{{ asset('public/product/'.$slider->image) }}" width="80px" height="80px">
		        @endif 
		    @endisset

			<div class="card">
			  <div class="card-header d-flex p-0">
			    <h3 class="card-title p-3">Description</h3>
			    <ul class="nav nav-pills ml-auto p-2">
			    	@php $l = 0; @endphp
			    	@forelse($language as $key=>$lang)
			      		<li class="nav-item"><a class="nav-link {{ ($l == 0) ? 'active' : '' }} " href="#tab_{{ $jk . $l}}" data-toggle="tab">{{ $lang }}</a></li>
			      		@php ++$l; @endphp
			  		@empty
			  		@endforelse      
			    </ul>
			  </div><!-- /.card-header -->
			  <div class="card-body">
			    <div class="tab-content">
			    	@php $i = 0; @endphp
			    	@forelse($language as $key=>$lang)
			    	@php
			    		$arrPrdt = !empty($product->sliders[$jk]->sliderAllTranslate[$i]) ? $product->sliders[$jk]->sliderAllTranslate[$i] : '';
			    	@endphp
		      		    <div class="tab-pane {{ ($i == 0) ? 'active' : '' }} " id="tab_{{ $jk . $i }}">
				         	{{ Form::textarea("content[$jk][]", !empty($arrPrdt->description) ? $arrPrdt->description : '', ['class'=>'form-control summernote', 'rows'=>4]) }}
				        </div>
				        @php ++$i; @endphp
			  		@empty
			  		@endforelse			      
			    </div><!-- /.tab-content -->
			  </div><!-- /.card-body -->
			</div>
		</div>
		@php ++$jk; @endphp

		@empty          
	@endforelse
@else
	<div class="slider">	
		<div class="form-group {{ $errors->has('slider_image') ? 'has-error' : ''}}">
		    {!! Form::label('slider_image', 'Slider Image', ['class' => 'control-label']) !!}
		    {!! Form::file('slider_image[0]', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
		    {!! $errors->first('slider_image', '<p class="help-block">:message</p>') !!}
		</div>

		<div class="card">
		  <div class="card-header d-flex p-0">
		    <h3 class="card-title p-3">Description</h3>
		    <ul class="nav nav-pills ml-auto p-2">
		    	@php $i = 0; @endphp
		    	@forelse($language as $key=>$lang)
		      		<li class="nav-item"><a class="nav-link {{ (++$i == 1) ? 'active' : '' }} " href="#tab_{{$i}}" data-toggle="tab">{{ $lang }}</a></li>
		  		@empty
		  		@endforelse      
		    </ul>
		  </div><!-- /.card-header -->
		  <div class="card-body">
		    <div class="tab-content">
		    	@php $i = 0; @endphp
		    	@forelse($language as $key=>$lang)
	      		  	<div class="tab-pane {{ (++$i == 1) ? 'active' : '' }} " id="tab_{{ $i }}">
			        	{{ Form::textarea('content[0][]', null, ['class'=>'form-control summernote', 'rows'=>4]) }}
			      	</div>
		  		@empty
		  		@endforelse
		    </div><!-- /.tab-content -->
		  </div><!-- /.card-body -->
		</div>
	</div>
@endif
</div>
@php $k=1; @endphp
@foreach ($arrProductTabs as $key=>$tabData)
	<div class="card">
		<div class="card-header d-flex p-0">
		  <h3 class="card-title p-3">{{ !empty($tabData->tabTranslate->name) ? $tabData->tabTranslate->name : '' }}</h3>
		  <ul class="nav nav-pills ml-auto p-2">
		  	@foreach ($language as $code=>$lang)
				<li class="nav-item"><a class="nav-link {{ ($loop->index == 0) ? 'active' : '' }}" href="#spec_{{$k}}_{{$loop->index}}" data-toggle="tab"> {{ $lang }} </a></li>
			@endforeach

		  </ul>
		</div><!-- /.card-header -->
		<div class="card-body">
		  	<div class="tab-content">
		  		@foreach ($language as $code=>$lang)
			  		@php
				  		if(isset($product)) {
				  			$strDesc = $product->specifications[$loop->index]->specificationTranslate->first()->description;
				  		} 
			  		@endphp
			        <div class="tab-pane show {{ ($loop->index == 0) ? 'active' : '' }}" id="spec_{{$k}}_{{$loop->index}}">
			           <textarea id="editor-{{$k}}-{{$loop->index+1}}" class="form-control summernote editor" rows="4" name="specifications[{{$tabData->id}}][]" cols="50"> {{ !empty($strDesc) ? $strDesc : '' }} </textarea>
			        </div>
			    @endforeach
		  	</div><!-- /.tab-content -->
		</div><!-- /.card-body -->
	</div>
	@php $k++; @endphp
@endforeach

<div class="form-group {{ $errors->has('meta_keywords') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Meta Keywords</h3>
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
                        {{ Form::textarea("meta_keywords[]", !empty($product->productAllTranslate[$loop->index]->meta_keywords) ? $product->productAllTranslate[$loop->index]->meta_keywords : '', ['class'=>'form-control summernote', 'rows'=>2]) }}
                        @if (!empty($errors->first("meta_keywords")))
                           {!! $errors->first("meta_keywords", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("meta_keywords.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>

<div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
    <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Meta Description</h3>
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
                        {{ Form::textarea("meta_description[]", !empty($product->productAllTranslate[$loop->index]->meta_description) ? $product->productAllTranslate[$loop->index]->meta_description : '', ['class'=>'form-control summernote', 'rows'=>2]) }}

                        @if (!empty($errors->first("meta_description")))
                           {!! $errors->first("meta_description", '<p class="help-block">:message</p>') !!}
                        @else
                            {!! $errors->first("meta_description.$loop->index", '<p class="help-block">:message</p>') !!}
                        @endif   
                    </div>
                @endforeach
            </div><!-- /.tab-content -->
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