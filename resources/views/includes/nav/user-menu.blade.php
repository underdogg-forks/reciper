<li class="{{ active_if_route_is('users/' . user()->id) }}"> {{-- home --}}
	<a href="/users/{{ user()->id }}" title="@lang('includes.user_home')">
		<i class="material-icons left">home</i>@lang('includes.user_home')
	</a>
</li>

<li> {{-- add recipe --}}
	<a href="/recipes/create" title="@lang('includes.new_recipe')">
		<i class="material-icons left">add</i>@lang('includes.new_recipe')
	</a>
</li>

<li class="{{ active_if_route_is('users/other/my-recipes') }}"> {{-- my recipes --}}
	<a href="/users/other/my-recipes" title="@lang('includes.my_recipes')">
		<i class="material-icons left">insert_drive_file</i>@lang('includes.my_recipes')
	</a>
</li>

<li class="{{ active_if_route_is('users') }}"> {{-- users --}}
	<a href="/users" title="@lang('includes.users')">
		<i class="material-icons left">people</i>@lang('includes.users')
	</a>
</li>

@admin
	<li class="{{ active_if_route_is('admin/statistics') }}"> {{-- statistics --}}
		<a href="/admin/statistics" title="@lang('includes.statistics')">
			<i class="material-icons left">insert_chart</i>@lang('includes.statistics')
		</a>
	</li>

	<li class="position-relative {{ active_if_route_is('admin/checklist') }}"> {{-- checklist --}}
		<a href="/admin/checklist" title="@lang('includes.checklist')" {{ $all_unapproved ? 'data-notif='.$all_unapproved : '' }} class="small-notif-btn">
			<i class="material-icons left">search</i>@lang('includes.checklist')
		</a>
	</li>

	<li class="position-relative {{ active_if_route_is('admin/feedback') }}"> {{-- feedback --}}
		<a href="/admin/feedback" title="@lang('includes.feedback')" {{ $all_feedback ? 'data-notif='.$all_feedback : '' }} class="small-notif-btn">
			<i class="material-icons left">feedback</i>@lang('includes.feedback')
		</a>
	</li>
	<li class="position-relative {{ active_if_route_is('admin/documents') }}"> {{-- Documents --}}
		<a href="/admin/documents" title="@lang('documents.docs')">
			<i class="material-icons left">work</i>@lang('documents.docs')
		</a>
	</li>
@endadmin

<li class="position-relative {{ active_if_route_is('notifications') }}"> {{-- notifications --}}
	<a href="/notifications" title="@lang('includes.notifications')" {{ $notifications ? 'data-notif='.$notifications : '' }} class="small-notif-btn">
		<i class="material-icons left">notifications</i>@lang('includes.notifications')
	</a>
</li>

<li class="{{ active_if_route_is('settings/general') }}"> {{-- settings/general --}}
	<a href="/settings/general" title="@lang('includes.general')" >
		<i class="material-icons left">build</i>@lang('includes.general')
	</a>
</li>

<li class="{{ active_if_route_is('settings/photo') }}"> {{-- settings/photo --}}
	<a href="/settings/photo" title="@lang('includes.photo')">
		<i class="material-icons left">build</i>@lang('includes.photo')
	</a>
</li>

@master
	<li class="position-relative {{ active_if_route_is('log-viewer/logs*') }}"> {{-- log-viewer --}}
		<a href="/log-viewer/logs" title="@lang('logs.logs')" {{ $all_logs ? 'data-notif='.$all_logs : '' }} class="small-notif-btn">
			<i class="material-icons left">library_books</i>@lang('logs.logs')
		</a>
	</li>
@endmaster

<li> {{-- logout --}} {{-- This button submits logout-form --}}
	<a href="#" title="@lang('includes.logout')" onclick="$('logout-form').submit()" id="_logout_btn">
		<i class="material-icons left">power_settings_new</i>@lang('includes.logout')
	</a>
</li>

{{-- logout-form --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
	@csrf <button type="submit"></button>
</form>