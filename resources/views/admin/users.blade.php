
    @if(auth()->user()->rechten == "2")
    <div class="card text-black bg-light mb-3">
        <div class="card-header text-center">
            Gebruikers 
        </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                            <th>#</th><th>Naam</th><th>E-mail</th><th>Rechten</th><th>Rating</th><th>Actief</th><th>KNSB ID</th>
                        </thead>
                        @foreach($users as $user)
                            <tr><td><a href="/users/{{$user->id}}">{{$user->id}}</a></td><td>{{$user->name}}</td><td>{{$user->email}}</td><td>{{$user->rechten}}</td><td>{{$user->rating}}</td><td>{{$user->active}}</td><td>{{$user->knsb_id}}</tr>
                        @endforeach                        
                </table>
            </div>
    </div>
       
   
    @endif
