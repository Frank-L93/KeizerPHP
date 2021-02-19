@extends('layouts.app')

@section('content')
     <div x-data="{admin: true, competition: true, users: true, ranking: true, rounds: true, presences: true, games: true}">
    <x-card-header>
        Admin-panel
    </x-card-header>
    <x-card-body>
        <div x-bind:class="{'hidden': !admin}" class="uppercase text-md">Pick one of the option to manage</div>
         <div x-bind:class="{'hidden': competition}"><livewire:config-competition :configs="$configs" /></div>
        <div x-bind:class="{'hidden': users}"><livewire:config-users :users="$users" /></div>
        <div x-bind:class="{'hidden': ranking}">{{$rankings}}</div>
        <div x-bind:class="{'hidden': rounds}">{{$rounds}}</div>
        <div x-bind:class="{'hidden': presences}">{{$presences}}</div>
        <div x-bind:class="{'hidden': games}">{{$games}}</div>
    </x-card-body>
    <x-card-footer>
        <x-grid cols="test">
            <span x-on:click="competition = ! competition, admin = false, users = true, ranking = true, rounds = true, presences = true, games = true" class="bg-blue-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-blue-600"><div>Manage Competition</div></span>
            <span x-on:click="users = ! users, admin = false, competition = true, ranking = true, rounds = true, presences = true, games = true" class="bg-blue-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-blue-600"><div>Manage Users</div></span>
        <span x-on:click="ranking = ! ranking, admin = false, users = true, competition = true, rounds = true, presences = true, games = true" class="bg-blue-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-blue-600"><div>Manage Ranking</div></span>
        <span x-on:click="rounds = ! rounds, admin = false, users = true, ranking = true, competition = true, presences = true, games = true" class="bg-blue-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-blue-600"><div>Manage Rounds</div></span>
        <span x-on:click="presences = ! presences, admin = false, users = true, ranking = true, rounds = true, competition = true, games = true" class="bg-blue-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-blue-600"><div>Manage Presences</div></span>
        <span x-on:click="games = ! games, admin = false, users = true, ranking = true, rounds = true, presences = true, competition = true" class="bg-blue-500 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-blue-600"><div>Manage Games</div></span>
              </x-grid>
    </x-card-footer>
        </div>
@endsection
