<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('includes.head')
	<title>@yield('title') - {{ config('app.name') }}</title>
</head>
<body>
	<div class="px-5" style="background:#eee;">
		@yield('content')
	</div>
</body>
</html>