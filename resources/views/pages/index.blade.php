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
    <div class="card">
        <div class="card-header">Dashboard</div>
            <div class="card-body">
            @foreach($rounds as $round)
                @if(Carbon\Carbon::parse($round->date)->format('j M Y') === Carbon\Carbon::parse(now())->format('j M Y'))
                    Vandaag is een ronde!
                    <br>
                    In deze ronde zijn er: 
                    <? $i = 0; $a = 0; $p = 0; ?>
                    @foreach($games as $game)
                    @if($game->round_id === $round->round)
                        @if($game->result === "Afwezigheid")
                            <? $a++; ?>
                        @else
                            <? $i++; ?>
                        @endif
                    @endif
                    @endforeach
                    <? echo $i; ?>
                     partijen & <? echo $a; ?> afwezigheden!
                    @foreach($presences as $presence)
                        @if($presence->round === $round->round)
                            @if($presence->presence === 1)
                                <? $p++; ?>
                            @endif
                        @endif
                    @endforeach
                    <br>
                    Er zullen <? echo $p; ?> spelers aanwezig zijn!
                @endif
            @endforeach
            </div>
        </div>
    </div>
@endsection
