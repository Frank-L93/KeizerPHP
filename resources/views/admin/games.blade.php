@auth    
    <div class="card text-black bg-light mb-3">  
        <div class="card-header text-center">
        @if($round_to_process->id == 0)
        @else
        <a href="/Admin/RankingList/{{$round_to_process->id}}/calculate" class="btn btn-sm btn-secondary float-left" >Verwerk Partijen voor ronde {{$round_to_process->id}}</a>
        @endif    Partijen
        </div>
            <div class="card-body">
                @foreach($rounds as $round)
                    <div class="card">
                        <div class="card-header" id="heading{{$round->id}}">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$round->id}}" aria-expanded="false" aria-controls="collapse{{$round->id}}">
                                Ronde {{$round->id}}
                            </button>
                            @if($round->processed == 1)
                            @else
                            <a href="/Admin/Match/{{$round->id}}/" class="btn btn-sm btn-secondary float-right" >Genereer Partijen voor Ronde {{$round->id}}</a>
                            @endif
                        </div>
                    </div>
                    @if(count($games)>0)
                    <div id="collapse{{$round->id}}" class="collapse" aria-labelledby="heading{{$round->id}}">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <th>Ronde</th><th>Wit</th><th>Zwart</th><th>Resultaat</th>
                                </thead> 
                            @foreach($games as $game)             
                            @if($game->result !== "Afwezigheid")
                                @if($round->id === $game->round_id)
                                <tr>
                                    <td><a href="/games/{{$game->id}}">{{$game->round_id}} - {{Carbon\Carbon::parse($round->date)->format('j M Y')}}</a></td>
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
                                    @endif
                                    <td>
                                        
                                        <a href="#" class="result" data-pk="{{$game->id}}" data-value="{{$game->result}}" data-title="Selecteer Resultaat" class="editable editable-click" style="color: gray;" data-original-title="" title="">
                                            {{$game->result}}
                                        </a>
                                    </td>
                                </tr>
                                @endif 
                            @endif
                            @endforeach
                        </table>
                        </div>
                    </div>
                    @endif
                @endforeach
        </div>
    </div>
@endauth




