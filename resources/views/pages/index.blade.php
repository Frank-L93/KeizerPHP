@extends('layouts.app')

@section('content')
    @guest
    <div class="card bg-warning mb-3">
        <div class="card-header">Login</div>
        @endguest
        @auth
    <div class="card">
            <div class="card-header">Menu van {{Auth::user()->name}}</div>
    @endauth
                <div class="card-body">
                    @guest
                        Login om gebruik te maken van het Menu.
                    @endguest
                    @auth
                    <div class="row">
                        <div class="col-sm text-center">
                            <a href="/presences">
                                <img src="/assets/icons/stopwatch.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Aanwezigheden</figcaption>
                            </a>
                        </div>
                        <div class="col-sm text-center">
                            <a href="/rankings">
                                <img src="/assets/icons/trophy.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Ranglijst</figcaption>
                            </a>
                        </div>
                        <div class="col-sm text-center">
                            <a href="/games">
                                <img src="/assets/icons/controller.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Partijen</figcaption>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm text-center">
                            <a href="/settings">
                                <img src="/assets/icons/gear.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Instellingen</figcaption>
                            </a>
                        </div>
                        <div class="col-sm text-center">
                            <a href="https://www.depion.nl">
                                <img src="/assets/icons/Chess_pdt45.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">De Pion</figcaption>
                            </a>
                        </div>
                        
                        <div class="col-sm text-center">
                            @if(Auth::user()->can('admin'))
                            <a href="/Admin">
                                <img src="/assets/icons/document-text.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Admin</figcaption>
                            </a>
                            @endif
                        </div>
                    </div>
                @endauth
            </div>
        @auth
            <div class="card-footer">
            </div>
        @endauth
    </div>
    @if($rounds === "Geen rondes meer!")
    <div class="card bg-warning">
        <div class="card-header">Er zijn geen rondes meer</div>
        <div class="card-body">
            <p>Het seizoen is afgelopen. Er zijn geen rondes meer om te spelen. Op 4 september start het nieuwe seizoen met de ALV</p>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-header">Dashboard van 
                            @foreach($rounds as $round)
                                @if(Carbon\Carbon::parse($round->date)->format('j M Y') === Carbon\Carbon::parse(now())->format('j M Y'))
                                    Ronde {{$round->round}} | VANDAAG  <?php $timediff = date_diff(Carbon\Carbon::parse($round->date), now()); if(Carbon\Carbon::parse($round->date) > now()){ echo "(over ".$timediff->h." uur, ".$timediff->i." minuten en ".$timediff->s." seconden)";}?>!
                                @else
                                   Ronde {{$round->round}} | {{Carbon\Carbon::parse($round->date)->format('j M Y')}}!
                                @endif
                            @endforeach
        </div>
        <div class="card-body">
            <div class="row">
                        <div class="col-sm text-center">
                             <img src="/assets/icons/play.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Partijen: {{$games->count()}}</figcaption>
                        </div>
                        <div class="col-sm text-center">
                         <img src="/assets/icons/person-fill.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Aanwezig: {{$presences->count()}}</figcaption>
                        </div>
                        <div class="col-sm text-center">
                            <img src="/assets/icons/lock.svg" alt="" width="64" height="64">
                            <figcaption class="figure-caption">Gemelde afwezigheden: {{$absences->count()}}
                        </div>
            </div>
        </div>
    </div>
    @endif
@endsection
