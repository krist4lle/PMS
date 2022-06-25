@component('mail::message')

This is your's password:
{{ $password }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
