{{-- Categories Dropdown menu --}}
<ul id="dropdown1" class="dropdown-content bottom-borders">
    @include('includes.nav.categories')
</ul>

{{-- User Dropdown menu --}}
<ul id="dropdown2" class="dropdown-content bottom-borders">
    @isset($visitor_likes)
        {{-- My loved recipes --}}
        <li class="{{ active_if_route_is(['recipes*']) }} {{ $visitor_likes > 0 ? '' : 'hide' }}" id="visitor-likes-icon">
            <a href="/recipes#my_likes">
                <i class="fas fa-heart fa-15x left with-red-hover"></i>
                @lang('recipes.loved')
                <span id="visitor-likes-number">{{ $visitor_likes }}</span>
            </a>
        </li>
    @endisset
    @auth
        <li class="{{ active_if_route_is(['users/' . user()->username]) }}"> {{-- home --}}
            <a href="/users/{{ user()->username }}" title="@lang('users.my_account')">
                <i class="fas fa-user-circle fa-15x left with-red-hover"></i>
                @lang('users.my_account')
            </a>
        </li>

        <li class="{{ active_if_route_is(['recipes/edit']) }}"> {{-- add recipe --}}
            <a href="#add-recipe-modal" title="@lang('recipes.new_recipe')" class="modal-trigger">
                <i class="fas fa-plus-circle fa-15x left with-red-hover"></i>@lang('recipes.new_recipe')
            </a>
        </li>

        <li class="{{ active_if_route_is(['users/other/my-recipes']) }}"> {{-- my recipes --}}
            <a href="/users/other/my-recipes" title="@lang('recipes.my_recipes')">
                <i class="fas fa-book-open fa-15x left with-red-hover"></i>
                @lang('recipes.my_recipes')
            </a>
        </li>

        <li class="{{ active_if_route_is(['users']) }}"> {{-- users --}}
            <a href="/users" title="@lang('users.users')">
                <i class="fas fa-user-friends fa-15x left with-red-hover"></i>
                @lang('users.users')
            </a>
        </li>

        <li class="{{ active_if_route_is(['favs']) }}"> {{-- favorites --}}
            <a href="/favs" title="@lang('messages.favorites')">
                <i class="fas fa-star fa-15x left with-red-hover"></i>
                @lang('messages.favorites')
            </a>
        </li>

        <li class="{{ active_if_route_is(['statistics']) }}"> {{-- statistics --}}
            <a href="/statistics" title="@lang('pages.statistics')">
                <i class="fas fa-chart-bar fa-15x left with-red-hover"></i>
                @lang('pages.statistics')
            </a>
        </li>

        @hasRole('admin')
            <li class="position-relative {{ active_if_route_is(['admin/approves']) }}"> {{-- approves --}}
                <a href="/admin/approves" title="@lang('approves.checklist')" class="{{ $unapproved_notif ? 'small-notif' : '' }}">
                    <i class="fas fa-search fa-15x left with-red-hover"></i>
                    @lang('approves.checklist')
                </a>
            </li>
            <li class="position-relative {{ active_if_route_is(['admin/feedback']) }}"> {{-- feedback --}}
                <a href="/admin/feedback" title="@lang('feedback.contact_us')" class=" {{ $feedback_notif ? 'small-notif' : '' }}">
                    <i class="fas fa-comment-dots fa-15x left with-red-hover"></i>
                    @lang('feedback.contact_us')
                </a>
            </li>
        @endhasRole

        <li class="position-relative {{ active_if_route_is(['notifications']) }}"> {{-- notifications --}}
            <a href="/notifications" title="@lang('notifications.notifications')" class="{{ $notifs_notif ? 'small-notif' : '' }} ">
                <i class="fas fa-bell fa-15x left with-red-hover"></i>
                @lang('notifications.notifications')
            </a>
        </li>

        <li class="{{ active_if_route_is(['settings', 'settings/photo', 'settings/general']) }}"> {{-- settings --}}
            <a href="/settings" title="@lang('settings.settings')">
                <i class="fas fa-cog fa-15x left with-red-hover"></i>
                @lang('settings.settings')
            </a>
        </li>

        @hasRole('master')
            <li class="position-relative {{ active_if_route_is(['master/manage-users']) }}"> {{-- manage-users --}}
                <a href="/master/manage-users" title="@lang('manage-users.manage-users')">
                    <i class="fas fa-user-cog fa-15x left with-red-hover"></i>
                    @lang('manage-users.management')
                </a>
            </li>

            <li class="position-relative {{ active_if_route_is(['master/visitors']) }}"> {{-- visitors --}}
                <a href="/master/visitors" title="@lang('visitors.visitors')">
                    <i class="fas fa-users fa-15x left with-red-hover"></i>
                    @lang('visitors.visitors')
                </a>
            </li>

            <li class="position-relative {{ active_if_route_is(['master/documents']) }}"> {{-- Documents --}}
                <a href="/master/documents" title="@lang('documents.documents')">
                    <i class="fas fa-copy fa-15x left with-red-hover"></i>
                    @lang('documents.documents')
                </a>
            </li>

            <li class="position-relative {{ active_if_route_is(['log-viewer/logs*']) }}"> {{-- log-viewer --}}
                <a href="/log-viewer/logs" title="@lang('logs.logs')" class=" {{ $logs_notif ? 'small-notif' : '' }}">
                    <i class="fas fa-file-code fa-15x left with-red-hover"></i>
                    @lang('logs.logs')
                </a>
            </li>
        @endhasRole

        <li> {{-- logout --}} {{-- This button submits logout-form --}}
            <a href="#" title="@lang('auth.logout')" onclick="$('logout-form').submit()">
                <i class="fas fa-sign-out-alt fa-15x left"></i>@lang('auth.logout')
            </a>
        </li>

       {{-- logout-form --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
            @csrf <button type="submit"></button>
        </form>
    @else
        {{-- Login --}}
        <li class="{{ active_if_route_is(['login']) }}">
            <a href="/login" title="@lang('auth.login')">
                <i class="fas fa-sign-in-alt fa-15x left with-red-hover"></i>@lang('auth.login')
            </a>
        </li>
        {{-- Register --}}
        <li class="{{ active_if_route_is(['register']) }}">
            <a href="/register" title="@lang('auth.register')">
                <i class="fas fa-pen-alt fa-15x left with-red-hover"></i>@lang('auth.register')
            </a>
        </li>
    @endauth
    <li class="{{ active_if_route_is(['help']) }}">
        <a href="/help" title="@lang('messages.help')">
            <i class="fas fa-question-circle fa-15x left"></i>@lang('messages.help')
        </a>
    </li>
    <li>
        <a href="#" title="@lang('messages.dark_mode')">
            <i class="fas fa-moon fa-15x left"></i>
            <div class="switch">
                <label class="ml-1">
                    @lang('messages.off')
                    <input type="checkbox" id="dark-theme-toggle" {{ getCookie('r_dark_theme') == 1 ? 'checked' : '' }}>
                    <span class="lever"></span>
                    @lang('messages.on')
                </label>
            </div>
        </a>
    </li>
</ul>

<nav class="no-select">
    <div class="nav-wrapper main" style="z-index:15">
        <div class="px-3 position-relative">
            {{-- Logo --}}
            <a href="/" title="@lang('home.home')" class="brand-logo no-select">
                <img src="{{ asset('storage/other/logo.png') }}" alt="logo" height="30" class="left">
                <span class="left pl-1">@lang('messages.app_name')</span>
            </a>
            {{-- Hamburger menu --}}
            <a href="#" data-target="mobile-demo" class="sidenav-trigger no-select">
                <i class="fas fa-bars"></i>
            </a>

            <div class="right">
                @auth
                    {{-- Dropdown Trigger 2 User --}}
                    <a class="right dropdown-trigger position-relative" href="#!" data-target="dropdown2" style="margin-top:.65rem">
                        <i class="user-icon-navbar z-depth-1 hoverable waves-effect waves-light d-block {{ $unapproved_notif || $feedback_notif || $notifs_notif || $logs_notif ? 'small-notif' : '' }}">
                            <img src="{{ asset('storage/small/users/' . user()->photo) }}">
                        </i>
                    </a>
                @else
                    {{-- Dropdown Trigger 2  --}}
                    <a class="right dropdown-trigger position-relative" href="#!" data-target="dropdown2" style="margin-top:.65rem" id="_hamb-menu">
                        <i class="fas fa-bars user-icon-navbar z-depth-1 hoverable waves-effect waves-light d-block center" style="line-height:42px">
                        </i>
                    </a>
                @endauth

                {{-- Search button --}}
                <a href="#" data-target="mobile-demo" class="right" style="margin:2px 27px 0 12px" title="@lang('pages.search')" id="nav-btn-for-search">
                    <i class="fas fa-search fa-15x" style="line-height:1.7"></i>
                </a>
            </div>

            {{-- Regular menu --}}
            <ul class="right hide-on-med-and-down right-borders">
                <li class="{{ active_if_route_is(['/']) }}">
                    <a href="/" title="@lang('home.home')">
                        @lang('home.home')
                    </a>
                </li>

                <li class="{{ active_if_route_is(['recipes', 'recipes/*']) }}">
                    <a href="/recipes" title="@lang('recipes.recipes')">
                        @lang('recipes.recipes')
                    </a>
                </li>

                <li> {{-- Dropdown Trigger 1 Categories --}}
                    <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                        @lang('pages.categories')
                        <i class="fas fa-caret-down fa-15x right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Search navigation --}}
<nav class="main-hover nav-search-form" id="nav-search-form">
    <div class="nav-wrapper container">
        <form action="{{ action('PagesController@search') }}" method="get">
            <div class="input-field">
                <input id="search-input" type="search" name="for" placeholder="@lang('pages.search_details')" required>
                <label class="label-icon" for="search-input">
                    <i class="fas fa-search"></i>
                </label>
            </div>
        </form>
    </div>
</nav>
