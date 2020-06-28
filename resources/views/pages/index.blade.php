@extends('layouts.app')

@section('content')
<div class="card">
    @guest
        <div class="card-header">Dashboard</div>
    @endguest
    @auth
        <div class="card-header">Dashboard van {{Auth::user()->name}}</div>
    @endauth
        <div class="card-body">
                @guest
                    Login om gebruik te maken van het Dashboard.
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
                            @if(Auth::user()->id == 21)
                            <a href="/Admin">
                                <img src="/assets/icons/document-text.svg" alt="" width="64" height="64">
                                <figcaption class="figure-caption">Admin</figcaption>
                            </a>
                            @endif
                        </div>
                      </div>
                    
                @endauth
        </div>
        <div class="card-footer">
        </div>
     </div>
</div>
                        {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                         @endif --}}
@endsection
