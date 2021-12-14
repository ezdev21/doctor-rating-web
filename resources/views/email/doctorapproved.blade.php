@component('mail::message')
# your request is approved

<img src="/storage/icons/tiruHakimLogo_longform_am.png" class="w-24 block">
email : {{$email}}<br>
password: {{$password}}
@component('mail::button', ['url' => 'http://tiruhakim.com/login'])
Login
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
