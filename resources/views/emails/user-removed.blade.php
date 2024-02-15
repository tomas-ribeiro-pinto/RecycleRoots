@component('mail::message')
{{ __('You have been removed from :team team.', ['team' => $team->name]) }}

{{ __('Your account has been deleted and all your data was erased.') }}

{{ __('If you have any queries regarding this email, please contact the :team team.', ['team' => $team->name]) }}
@endcomponent
