@extends('layouts.app')

@section('content')
<div class="card-group">
    <div class="card text-black bg-light mb-3">
        <div class="card-header">
            Admin Dashboard van {{Auth::user()->name}}
        </div>
            <div class="card-body">
                @guest
                    Login om gebruik te maken van het Dashboard.
                @endguest
                @auth
                Je kunt hieronder gebruik maken van de verschillende Adminpagina's.
                <div class="card-group">
                <div class="card text-black bg-warning mb-3" style="max-width: 25em;">
                    <div class="card-header text-center">
                        Clubavond
                    </div>
                    <div class="card-body">
                    De volgende stappen moeten worden uitgevoerd om een clubavond af te handelen:
                    <ul>
                        <li>Genereer partijen voor aanwezigen op basis van stand</li>
                        <li>Vul scores in</li>
                        <li>Bereken stand</li>
                    </ul>
                
                    </div>
                </div>
                <div class="card text-black bg-light mb-3" style="max-width: 25em;">
        <div class="card-header text-center">
            Seizoen
        </div>
            <div class="card-body">
                De volgende stappen moeten worden uitgevoerd om een nieuw seizoen op te starten:
                <ul>
                    <li>Stel Seizoeneinde in op 1 onder Configuratie</li>
                    <li>Reset via knop die hieronder verschijnt</li>
                    <li>Verwijder eventuele gebruikers in je Database (Hier komt nog een functie voor!)</li> 
                    <li>Laad nieuwe Ratinglijst</li>
                    <li>Genereer Ranglijst</li>
                    <li>Creëer nieuwe rondes</li>
                    <li>Genereer aanwezigheden</li>
                    <li>Pas eventuele waarden aan</li>
                </ul>
                @foreach($configs as $config)
                @if($config->EndSeason == "0")
                @else
                <a href="/Admin/Reset" class="btn btn-secondary btn-xs pull-left">Reset seizoen</a>
                @endif
                @endforeach
        </div>
    </div>   
                </div>       
                @endauth
            </div>  
     </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="#ratinglist" role="tab" data-toggle="tab">Ratinglijst</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#config" role="tab" data-toggle="tab">Configuratie</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#users" role="tab" data-toggle="tab">Gebruikers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#presences" role="tab" data-toggle="tab">Aanwezigheden</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#rankings" role="tab" data-toggle="tab">Ranglijst</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#rounds" role="tab" data-toggle="tab">Rondes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#games" role="tab" data-toggle="tab">Partijen</a>
    </li>
   
    
</ul>
<div class="tab-content">
    <br>
    <div role="tabpanel" class="tab-pane active" id="ratinglist">
        <p>
            @include('admin.ratinglist')
        </p>
    </div>
     <div role="tabpanel" class="tab-pane" id="config">
        <p>
            @include('admin.config')
        </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="users">
        <p>
            @include('admin.users')
        </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="presences">
        
        <p>
            @include('admin.presences')
        </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="rankings">
        <p>
            @include('admin.rankings')
        </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="rounds">
        <p>
            @include('admin.rounds')
        </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="games">
        <p>
            @include('admin.games')
        </p>
    </div>

 
</div>
@endsection

