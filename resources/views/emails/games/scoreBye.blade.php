@component('mail::message')
# Er is een uitslag ingevuld voor een partij van jou

In ronde __{{$round}}__ heb jij een afwezigheidspartij gehad.
Je was dus __{{$gamescore}}__! De score voor de ranglijst zal binnenkort berekend worden.

@component('mail::button', ['url' => env('APP_URL').'/games'])
Bekijk hier de uitslagen van alle partijen
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent