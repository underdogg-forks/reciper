@extends('layouts.app')

@section('title', trans('pages.feedback'))

@section('content')

<h1 class="headline">@lang('pages.feedback')</h1>

{!! Form::open(['action' => 'ContactController@store', 'method' => 'POST', 'class' => 'form']) !!}
	<div class="form-group simple-group">
		{{ Form::label('email', trans('form.email')) }}
		{{ Form::text('email', '', ['placeholder' => trans('form.email')]) }}
	</div>
	<div class="form-group simple-group">
		{{ Form::label('message', trans('form.message')) }}
		{{ Form::textarea('message', '', ['placeholder' => trans('form.message')]) }}
	</div>
	<div class="form-group simple-group">
		{{ Form::submit(trans('form.send'), ['class' => 'btn btn-main']) }}
	</div>
{!! Form::close() !!}

@endsection