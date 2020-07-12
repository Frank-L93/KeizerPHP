@extends('layouts.app')

@section('content')
    <div class="card">
        @auth
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
                        <tr><td><a href="/ranking/{{$rank->id}}"><?php echo $i; $i++;?></a></td><td>{{$rank->user->name}}</td><td>{{$rank->score}}</td><td>{{$rank->value}}</td>
                        
                        @if(settings()->has('ranking') && (settings()->get('ranking') == 1))
                        <td>{{$rank->amount}}</td><td>{{$rank->gamescore}}</td><td>{{$rank->TPR}}</td>
                        @endif
                        </tr>
                    @endforeach
                    
            </table>
        
        </div>
        <div class="card-footer clearfix">
        </div> 
        @endauth
    </div>
@endsection