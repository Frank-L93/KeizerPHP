@extends('layouts.app')

@section('content')
@auth
@inject('Details', 'App\Services\DetailsService')
    <div class="card">
        <div class="card-header text-center">Ranglijst</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                        <th>#</th><th>Naam</th><th>Score</th><th>Waarde</th>
                        @if(settings()->has('ranking') && (settings()->get('ranking') == 1))
                        <th>Gespeelde Partijen</th><th>Resultaat</th><th>TPR</th>
                        @endif
                    </thead>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($ranking as $rank)
                        <tr><td><a href="#detail{{$rank->id}}" class="badge badge-pill badge-info" data-toggle="modal" data-target="#detail{{$rank->id}}"><?php echo $i; $i++;?></a></td><td>{{$rank->user->name}}</td><td>{{$rank->score}}</td><td>{{$rank->value}}</td>
                        
                        @if(settings()->has('ranking') && (settings()->get('ranking') == 1))
                        <td>{{$rank->amount}}</td><td>{{$rank->gamescore}}</td><td><?php echo round($rank->TPR);?></td>
                        @endif
                        </tr>
                    @endforeach
                    
            </table>
        
        </div>
        <div class="card-footer clearfix">
        </div> 
    </div>
    @foreach($ranking as $rank)
    <div class="modal fade" id="detail{{$rank->id}}" tabindex="-1" role="dialog" aria-labelledby="detail{{$rank->id}}Title" aria-hidden="true" style="padding-right:50% !important">
        <div class="tableModal" style="padding-right:50% !important">
            <div class="table-cellModal">
                <div class="model-open">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detail{{$rank->id}}Title">Partijen van {{$rank->user->name}} (Waarde: {{$rank->value}})</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover"><thead class="thead-dark"><th>Wit</th><th>Zwart</th><th>Resultaat</th><th>Ronde</th><th>Score</th></thead>
                                   @foreach($Details->Games($rank->user_id) as $game)
                                   <tr><td>{{$Details->PlayerName($game->white)}}</td><td>{{$Details->PlayerName($game->black)}}</td><td>{{$game->result}}</td><td>{{$game->round_id}}</td><td>{{$Details->CurrentScore($rank->user_id, $game->round_id)}}</td></tr>
                                    @endforeach
                                   
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
   @endforeach
   @endauth
@endsection