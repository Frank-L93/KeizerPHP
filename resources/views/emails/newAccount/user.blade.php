@component('mail::message')
# Welkom bij de vereniging!

Beste __{{$user->name}}__,

De competitieleider van jouw vereniging heeft een account voor je aangemaakt in de competitiemanager.

Met dit account kun jij gemakkelijk meedoen met de competitie van je vereniging. Log in en geef aan op welke
speelavonden jij aanwezig zult zijn zodat je ingedeeld kan worden.

Het eerste wachtwoord van jouw account is __{{$password}}__
Er wordt aangeraden om dit wachtwoord zo snel mogelijk aan te passen.

@component('mail::button', ['url' => $url])
Activeer je account en beheer je aanwezigheden
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent