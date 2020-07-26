@auth
    
    <div class="card text-black bg-light mb-3">
       
        <div class="card-header text-center">
            Rondes<a href="/Admin/Rounds/create" class="btn btn-sm btn-secondary float-right" >Creeër ronde</a></div>
            <div class="card-body">
                @if(count($rounds)>0)
                <table class="table table-hover">
                <thead class="thead-dark">
                    <th>Ronde</th><th>Datum</th><th>Pas aan</th><th>Verwijder</th>
                </thead>
                @foreach($rounds as $round)    
                    <tr>
                        <td><a href="/rounds/{{$round->id}}">{{$round->round}}</a></td><td>{{Carbon\Carbon::parse($round->date)->format('j M Y')}}</td>
                        <td><a href="/rounds/{{$round->id}}/edit" class="btn btn-sm btn-info"><img src="/assets/icons/pencil.svg" alt="" width="24" height="24"></a></td>
                        <td>
                                    {!!Form::open(['action'=>['AdminController@DestroyRounds', $round->id], 'method'=>'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Verwijder', ['class' => 'btn btn-sm btn-danger'])}}
                                    {!!Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
            @endif
        </div>

    </div>   

@endauth 

