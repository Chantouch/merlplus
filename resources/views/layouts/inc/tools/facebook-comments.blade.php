@if (config('settings.activation_facebook_comments') and config('services.facebook.client_id'))
	<div id="fb-root"></div>
	<div class="fb-comments" data-href="{{ Request::url() }}" data-width="100%" data-numposts="5"></div>
@endif