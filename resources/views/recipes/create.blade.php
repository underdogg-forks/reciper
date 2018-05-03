@extends('layouts.app')

@section('title', trans('recipes.add_recipe'))

@section('content')

{!! Form::open(['action' => 'RecipesController@store', 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}

	<div class="recipe-buttons">
		{{ Form::submit('', ['class' => "edit-recipe-icon icon-save"]) }}
	</div>

	<h2 class="headline">@lang('recipes.add_recipe')</h2>

	{{-- Title --}}
	<button class="accordion" type="button">@lang('recipes.title')</button>
	<div class="accordion-panel">
		<div class="form-group">
			{{ Form::text('title', '', ['placeholder' => trans('recipes.title')]) }}
		</div>
	</div>

	{{-- Intro --}}
	<button class="accordion" type="button">@lang('recipes.intro')</button>
	<div class="accordion-panel">
		<div class="form-group">
			{{ Form::textarea('intro', '', ['placeholder' => trans('recipes.short_intro')]) }}
		</div>
	</div>

	{{-- Ingredients --}}
	<button class="accordion" type="button">@lang('recipes.ingredients')</button>
	<div class="accordion-panel">
		<div class="form-group">
			{{ Form::textarea('ingredients', '', ['placeholder' => trans('recipes.ingredients_description')]) }}
		</div>
	</div>

	{{-- Advice --}}
	<button class="accordion" type="button">@lang('recipes.advice')</button>
	<div class="accordion-panel">
		<div class="form-group">
			{{ Form::textarea('advice', '', ['placeholder' => trans('recipes.advice_description')]) }}
		</div>
	</div>

	{{-- Text --}}
	<button class="accordion" type="button">@lang('recipes.text_of_recipe')</button>
	<div class="accordion-panel">
		<div class="form-group">
			{{ Form::textarea('text', '', ['placeholder' => trans('recipes.text_description')]) }}
		</div>
	</div>

	{{-- Category --}}
	<button class="accordion" type="button">@lang('recipes.category')</button>
	<div class="accordion-panel">
		<div class="form-group simple-group">
			<select name="category_id">
				@foreach ($categories as $category)
					<option selected value="{{ $category->id }}">{{ $category->category }}</option>
				@endforeach
			</select>
		</div>
	</div>

	{{-- Time --}}
	<button class="accordion" type="button">@lang('recipes.time')</button>
	<div class="accordion-panel">
		<div class="form-group simple-group">
			{{ Form::label('time', trans('recipes.time_description')) }}
			{{ Form::number('time', '0') }}
		</div>
	</div>

	{{-- Image --}}
	<button class="accordion" type="button">@lang('recipes.image')</button>
	<div class="accordion-panel">
		<div class="form-group simple-group" style="text-align:center;">
			{{ Form::label('src-image', trans('recipes.select_file'), ['class' => 'image-label']) }}
			{{ Form::file('image', ['style' => "display:none;", "id" => "src-image"]) }}
			
			<section class="preview-image">
					<img src="{{ asset('storage/images/default.jpg') }}" alt="@lang('recipes.image')" id="target-image">
			</section>
		</div>
	</div>

{!! Form::close() !!}

@endsection