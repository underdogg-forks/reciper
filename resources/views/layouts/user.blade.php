<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('includes.head')
	<title>@yield('title') - Delicious Food</title>
	@yield('head')
</head>
<body>

	@include('includes.navbar')

	@include('includes.profile-menu-line')

	@include('includes.messages')

	<div class="wrapper" style="padding-top: 1em;">
		@yield('content')
	</div>

    @include('includes.footer')

    {{ Visitor::log() }}

    <!-- Javascript -->
	<script type="text/javascript" src="{{ URL::asset('js/main.js') }}?ver={{ env('APP_VER') }}"></script>
	@yield('script')
</body>
</html>