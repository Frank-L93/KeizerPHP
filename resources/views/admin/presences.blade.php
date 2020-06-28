
    <div class="card text-black bg-light mb-3">
       
        <div class="card-header text-center">
        
                <a class="btn btn-sm btn-secondary float-left" href="/Admin/Presences/create" role="button">Genereer Aanwezigheden</a>
         
            Aanwezigheid
        </div>
            <div class="card-body">
                @if(count($presences)>0)
                <table class="table table-hover">
                    <thead class="thead-dark">
                            <th>Naam</th><th>Ronde</th><th>Aanwezig</th><th>Verwijder</th>
                        </thead>
                        @foreach($presences as $presence)    
                            <tr>
                                <td><a href="/presences/{{$presence->id}}">{{$presence->user->name}}</a></td><td>{{$presence->round}}</td><td>{{$presence->presence}}</td>
                                <td>
                                    {!!Form::open(['action'=>['AdminController@DestroyPresences', $presence->id], 'method'=>'POST', 'class' => 'pull-right'])!!}
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

