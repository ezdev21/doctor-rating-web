@component('mail::message')
# your request approved

<img src="/storage/icons/tiruHakimLogo_longform_am.png" class="w-24 block">
email : {{$email}}<br>
password: {{$password}}

@component('mail::button', ['url' => ''])
Login
@endcomponent

Thanks,<br>
Tiru Hakim
@endcomponent
