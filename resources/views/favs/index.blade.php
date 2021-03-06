@extends('layouts.auth')

@section('title', trans('messages.favorites'))

@section('content')

<div class="page">
    <div class="center mb-4">
        <h1 class="header">
            <i class="fas fa-star" style="color:#d49d10"></i> 
            @lang('messages.favorites')
        </h1>
    </div>
    <div class="pb-3">
        @foreach ($categories as $category)
            <a href="/favs/{{ $category['id'] }}"
                class="btn btn-sort {{ active_if_route_is(["/favs/{$category['id']}"]) }}"
            >
                <span class="pl-1">{{ $category['name'] }}</span>
            </a>
        @endforeach
    </div>

    {{--  Cards  --}}
    @component('comps.card', ['recipes' => $recipes]) @endcomponent
</div>

@endsection