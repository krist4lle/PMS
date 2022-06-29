@component('mail::message')

This is your credentials<br>
Email: {{ $email }}<br>
Password: {{ $password }}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
