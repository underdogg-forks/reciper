<header class="home-header">
	<div class="header-content">

		<h1>{{ config('app.name') }}</h1>
		<div class="home-meal">
			@lang('header.what_u_like')
			<br />
			<a href="search?for={{ trans('header.breakfast') }}">{{ title_case(trans('header.breakfast')) }}</a>, 
			<a href="search?for={{ trans('header.lunch') }}">@lang('header.lunch')</a>
			@lang('header.or') 
			<a href="search?for={{ trans('header.dinner') }}">@lang('header.dinner')</a>?
			<br />
			@lang('header.or_maybe') 
			<a href="search?for=simple">@lang('header.sth_new')</a>
		</div>

		{{--  Form  --}}
		<form action="{{ action('PagesController@search') }}" method="get" class="header-search">
			<div style="position:relative;">
				<div class="home-search" id="search-form">
					<input type="search" name="for" id="header-search-input" placeholder="@lang('pages.search_details')">
				</div>
				<button type="submit" class="home-button" id="home-search-btn">
					<i class="material-icons">search</i>
				</button>
			</div>
		</form>
	</div>
</header>