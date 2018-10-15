@extends('layouts.app')

@section('title', trans('notifications.notifications'))

@section('content')

<div class="page">
    <div class="center pb-4">
        <h1 class="header">
            <i class="fas fa-bell red-text"></i> 
            @lang('notifications.notifications') 
            {{ $notifications->count() > 0 ? ': ' . $notifications->count() : '' }}
        </h1>
    </div>
    
    @forelse ($notifications->chunk(3) as $chunk)
        <div class="row">
            @foreach ($chunk as $notif)
                <div class="col s12 m6 l4">
                    <div class="card-panel px-3 {{ $notif->for_admins === 1 ? 'main-light' : '' }}">
                        <span>
                            <h6><i class="fas fa-bell fa-15x left main-text"></i> {{ $notif->title }}</h6>
                            <p>{{ $notif->message }}</p>
                            <span class="grey-text right">{{ time_ago($notif->created_at) }}</span>

                            @if ($notif->for_admins === 0 || user()->hasRole('master'))
                                <form action="{{ action('NotificationController@destroy', ['notification' => $notif->id]) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="btn-small red" onclick="if (!confirm('@lang('notifications.sure_to_delete')')) event.preventDefault()">@lang('forms.deleting')</button>
                                </form>
                            @else
                                @lang('admin.message_for_admin')
                            @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        @component('comps.empty')
            @slot('text')
                @lang('messages.no_messages')
            @endslot
        @endcomponent
    @endforelse
        
    {{ $notifications->links() }}
</div>

@endsection