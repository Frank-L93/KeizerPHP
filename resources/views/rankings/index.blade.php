@extends('layouts.app')

@section('content')
    <div class="card">
        @auth
        <div class="card-header text-center">Ranglijst</div>
        
    
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                        <th>#</th><th>Naam</th><th>Score</th><th>Waarde</th>
                    </thead>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($ranking as $rank)
                        <tr><td><a href="/ranking/{{$rank->id}}"><?php echo $i; $i++;?></a></td><td>{{$rank->user->name}}</td><td>{{$rank->score}}</td><td>{{$rank->value}}</td></tr>
                    @endforeach
                    
            </table>
        
        </div>
        <div class="card-footer clearfix">
        </div> 
        @endauth
    </div>
@endsection