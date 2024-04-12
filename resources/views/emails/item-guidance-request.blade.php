@component('mail::message')
{{ __('New item guidance request from:') }}
{{ $name }} ({{ $email }})

{{ __('Postcode:') }}
{{ $postcode }}

{{ __('Item:') }}
{{ $item }}

{{ __('Message:') }}
{{ $message }}

{{ __('Thank you') }},<br>
{{ config('app.name') }}
@endcomponent
