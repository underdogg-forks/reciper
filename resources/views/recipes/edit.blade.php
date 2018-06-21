@extends('layouts.app')

@section('title', trans('recipes.add_recipe'))

@section('content')

<form action="{{ action('RecipesController@update', ['recipe' => $recipe->id]) }}" method="post" class="page" enctype="multipart/form-data" id="form-update-recipe">

	<div class="row"> @method('put') @csrf
		<div class="col s12">
			<div class="center-align">
				<h1 class="headline pb-4">@lang('recipes.add_recipe')</h1>
			</div>

			<div class="fixed-action-btn">
				<a href="#" class="btn-floating main btn-large pulse z-depth-3"><i class="large material-icons">more_vert</i></a>
				<ul>
					<li> {{--  Delete button  --}}
						<delete-recipe-btn
							recipe-id="{{ $recipe->id }}"
							deleted-fail="{{ trans('recipes.deleted_fail') }}"
							deleting="{{ trans('recipes.deleting') }}"
							confirm="{{ trans('recipes.are_you_sure_to_delete') }}">
						</delete-recipe-btn>
					</li>
					<li> {{--  Publish button  --}}
						<a href="#" class="btn-floating green btn-large" title="@lang('recipes.press_to_publish')" id="publish-btn">
							<i class="large material-icons">send</i>
						</a>
						<input type="checkbox" name="ready" value="1" class="d-none" id="ready-checkbox">
					</li>
					<li> {{--  View button  --}}
						<a href="/recipes/{{ $recipe->id }}" class="btn-floating green btn-large" title="@lang('recipes.view_recipe')">
							<i class="large material-icons">remove_red_eye</i>
						</a>
					</li>
					<li> {{--  Save button  --}}
						<button type="submit" id="submit-save-recipe" title="@lang('recipes.save_recipe_desc')" class="btn-floating green btn-large">
							<i class="large material-icons">save</i>
						</button>
					</li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m4"> {{-- Title --}}
				@component('comps.forms.title-field')
					@slot('title')
						{{ $recipe->getTitle() }}
					@endslot
				@endcomponent
			</div>
	
			<div class="col s12 m4"> {{-- Time --}}
				@component('comps.forms.time-field')
					@slot('time')
						{{ $recipe->time }}
					@endslot
				@endcomponent
			</div>
	
			<div class="col s12 m4"> {{-- Meal time --}}
				@component('comps.forms.meal-field', ['meal' => $meal])
					@slot('meal_id')
						{{ $recipe->meal->id }}
					@endslot
				@endcomponent
			</div>
		</div>

		<div class="row">
			<div class="col s12 l6"> {{-- Ingredients --}}
				@component('comps.forms.ingredients-field')
					@slot('ingredients')
						{{ $recipe->getIngredients() }}
					@endslot
				@endcomponent
			</div>
	
			<div class="col s12 l6"> {{-- Advice --}}
				@component('comps.forms.intro-field')
					@slot('intro')
						{{ $recipe->getIntro() }}
					@endslot
				@endcomponent
			</div>
		</div>

		<div class="col s12 mb-2"> {{-- Text --}}
			@component('comps.forms.text-field')
				@slot('text')
					{{ $recipe->getText() }}
				@endslot
			@endcomponent
		</div>

		<div class="row">
			<div class="col s12 m6"> {{-- Categories --}}
				<categories-field
					locale="{{ locale() }}"
					:recipe-categories="{{ json_encode($recipe->categories->toArray()) }}"
					label="@lang('recipes.category')"
					select="@lang('form.select')"
					categories-title="@lang('recipes.categories_title')"
					deleting="@lang('form.deleting')"
					add="@lang('form.add')">
					@include('includes.preloader')
				</categories-field>
			</div>
	
			<div class="col s12 m6"> {{-- Image --}}
				@component('comps.forms.image-field')
					@slot('image')
						{{ $recipe->image }}
					@endslot
					@slot('alt')
						{{ $recipe->title }}
					@endslot
				@endcomponent
			</div>
		</div>
	</div>
</form>

@endsection

@section('script')
	@include('includes.js.floating-btn')
@endsection