@component('mail::message')
# De partijen voor de volgende ronde zijn ingedeeld.

In ronde __{{$round}}__ heb jij een bye of een afwezigheid.

@component('mail::button', ['url' => '/rankings'])
Bekijk hier alle partijen
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent