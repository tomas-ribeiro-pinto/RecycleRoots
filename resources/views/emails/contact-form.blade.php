@component('mail::message')
{{ __('New contact request from:') }}
{{ $name }} ({{ $email }})

{{ __('Postcode:') }}
{{ $postcode }}

{{ __('Subject:') }}
{{ $r_subject }}

{{ __('Message:') }}
{{ $message }}

{{ __('Thank you') }},<br>
{{ config('app.name') }}
@endcomponent
