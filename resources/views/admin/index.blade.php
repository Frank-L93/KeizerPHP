@extends('layouts.app')

@section('content')
     <div x-data="{admin: true, competition: true, users: true, ranking: true, rounds: true, presences: true, games: true}">
    <x-card-header>
        Admin-panel
    </x-card-header>
    <x-card-body>
        <div x-bind:class="{'hidden': !admin}" class="uppercase text-md">Pick one of the option to manage</div>
         <div x-bind:class="{'hidden': competition}"><livewire:config-competition :configs="$configs" /></div>
        <div x-bind:class="{'hidden': users}">{{$users}}</div>
        <div x-bind:class="{'hidden': ranking}">{{$rankings}}</div>
        <div x-bind:class="{'hidden': rounds}">{{$rounds}}</div>
        <div x-bind:class="{'hidden': presences}">{{$presences}}</div>
        <div x-bind:class="{'hidden': games}">{{$games}}</div>
    </x-card-body>
    <x-card-footer>
        <x-grid cols="test">
            <span x-on:click="competition = ! competition, admin = false, users = true, ranking = true, rounds = true, presences = true, games = true" class="bg-green-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-green-600"><template x-if="competition == false"><div>Save Competition</div></template><template x-if="competition == true"><div>Manage Competition</div></template></span>
        <span x-on:click="users = ! users, admin = false, competition = true, ranking = true, rounds = true, presences = true, games = true" class="bg-green-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-green-600"><template x-if="users == false"><div>Save Users</div></template><template x-if="users == true"><div>Manage Users</div></template></span>
        <span x-on:click="ranking = ! ranking, admin = false, users = true, competition = true, rounds = true, presences = true, games = true" class="bg-green-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-green-600"><template x-if="ranking == false"><div>Save Ranking</div></template><template x-if="ranking == true"><div>Manage Ranking</div></template></span>
        <span x-on:click="rounds = ! rounds, admin = false, users = true, ranking = true, competition = true, presences = true, games = true" class="bg-green-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-green-600"><template x-if="rounds == false"><div>Save Rounds</div></template><template x-if="rounds == true"><div>Manage Rounds</div></template></span>
        <span x-on:click="presences = ! presences, admin = false, users = true, ranking = true, rounds = true, competition = true, games = true" class="bg-green-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-green-600"><template x-if="presences == false"><div>Save Presences</div></template><template x-if="presences == true"><div>Manage Presences</div></template></span>
        <span x-on:click="games = ! games, admin = false, users = true, ranking = true, rounds = true, presences = true, competition = true" class="bg-green-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-green-600"><template x-if="games == false"><div>Save Games</div></template><template x-if="games == true"><div>Manage Games</div></template></span>
              </x-grid>
    </x-card-footer>
        </div>
@endsection
