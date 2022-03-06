@component('mail::message')
# Welkom bij de SchaakManager!

Beste __{{$club->contact}}__,

Fijn dat je gebruik wilt gaan maken van CompetitionManager!
Bevestig hieronder dat je de vereniging wilt activeren, vanaf dan kan er gebruik gemaakt worden van de applicatie.

@component('mail::button', ['url' => $url])
Activeer de club
@endcomponent

Mocht je vragen of opmerkingen hebben, dan kun je altijd een mail sturen naar info@schaakmanager.nl

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent