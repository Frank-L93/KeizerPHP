@component('mail::message')
# De ranglijst is vernieuwd. De top 3 is nu als volgt:

@component('mail::table')
| Naam | Score | Waarde |
| ------------- |:-------------:| --------:|
@php
$i = 1;
@endphp
@foreach($ranking as $rank)
| {{$rank[$i][1]->name}} | {{$rank[$i][0]->score}} | {{$rank[$i][0]->value}} |
@php
$i++;
@endphp
@endforeach
@endcomponent


@component('mail::button', ['url' => env('APP_URL').'/rankings'])
Bekijk de volledige ranking hier.
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent