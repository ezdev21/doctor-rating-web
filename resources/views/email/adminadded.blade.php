@component('mail::message')
# your rquest approved

<img src="/storage/icons/tiruHakimLogo_longform_am.png" class="w-24 block">
email : {{$email}}<br>
password: {{$password}}

@component('mail::button', ['url' => 'http://tiruhakim.com/login'])
Login
@endcomponent

Thanks,<br>
Tiru Hakim
@endcomponent
