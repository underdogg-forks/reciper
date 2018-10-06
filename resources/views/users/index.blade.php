@extends('layouts.app')

@section('title', trans('users.all_authors'))

@section('content')

<div class="page">
    <div class="center pb-2">
        <h1 class="headline">@lang('users.all_authors') <span class="red-text">{{ number_format($users->count()) }}</span></h1>
    </div>

    <div class="row">
        @foreach ($users as $user)
            <div class="col s12 m6 l4">
                <ul class="collection my-1 z-depth-1 hoverable">
                    <li class="collection-item avatar">
                        <a href="/users/{{ $user->id }}">
                            <img src="{{ asset('storage/small/users/'.$user->image) }}" alt="{{ $user->name }}" class="circle">
                        </a>
                        <span class="title">{!! get_online_icon(time_ago($user->updated_at)) !!} {{ $user->name }}</span>
                        <p>@lang('date.online') {{ time_ago($user->updated_at, 'online') }}</p>
                        <p>@lang('users.exp'): {{ $user->exp }}</p>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
    {{ $users->links() }}
</div>


@endsection
