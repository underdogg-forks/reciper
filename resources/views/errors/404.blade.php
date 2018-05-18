@component('components.error')
	@slot('error')
		@lang('errors.404')
	@endslot
	@slot('title')
		@lang('errors.404_title')
	@endslot
	@lang('errors.404_description')
@endcomponent