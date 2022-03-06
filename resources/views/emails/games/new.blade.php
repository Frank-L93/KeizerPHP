@component('mail::message')
# De partijen voor de volgende ronde zijn ingedeeld.

In ronde __{{$round}}__ speel jij tegen __{{$opponnent}}__

@component('mail::button', ['url' => env('APP_URL').'/rankings'])
Bekijk hier alle partijen
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent