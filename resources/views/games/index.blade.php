@extends('layouts.app')

@section('content')
<div class="card text-black bg-light mb-3">
        <div class="card-header text-center">
            Partijen
        </div>
        <div class="card-body">
        @foreach($rounds as $round)
            <div class="card">
                <div class="card-header" id="heading{{$round->id}}">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$round->id}}" aria-expanded="false" aria-controls="collapse{{$round->id}}">
                                Ronde {{$round->id}} | {{Carbon\Carbon:: parse($round->date)->format('j M Y')}}
                            </button>
                </div>
            </div>
            <div id="collapse{{$round->id}}" class="collapse" aria-labelledby="heading{{$round->id}}">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <th>Wit</th><th>Zwart</th><th>Resultaat</th><th>Jouw Score</th>
                        </thead>
                        @foreach($games as $game)             
                            
                                @if($round->id === $game->round_id)
                                    <tr>
                                        @foreach($users as $user)
                                            @if($user->id === $game->white)
                                                <td>{{$user->name}}</td>
                                            @endif
                                        @endforeach
                                        @foreach($users as $user)
                                            @if($user->id === intval($game->black))
                                                <td>{{$user->name}}</td>
                                            @endif 
                                        @endforeach
                                        @if($game->black === "Bye")
                                            <td>Bye</td>
                                        @elseif($game->black === "Club")
                                            <td>Clubverplichting</td>
                                        @elseif(auth()->user()->id === $game->white && $game->black === "Personal")
                                            <td>Persoonlijke reden</td>
                                            @elseif($game->black === "Other" || $game->black === "Empty")
                                            <td>Afwezig</td>
                                            @else
                                            <td>Afwezig</td>
                                        @endif
                                        <td>{{$game->result}}</td>
                                        @if($game->white === $current_user OR $game->black === $current_user)
                                            
                                            @foreach($scores as $score)
                                                @if($score['game'] === $game->id)
                                                    <td>{{$score['score']}}</td>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tr>
                                @endif 
                            
                        @endforeach
                    </table>
                </div>
            </div>
            @endforeach
        </div>
</div>
@endsection