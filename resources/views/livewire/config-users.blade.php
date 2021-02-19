<div>
    <table>
        <thead><tr><th>Naam</th><th>Email</th><th>KNSB ID</th><th>Rating</th><th>Beschikbaar</th><th>Ingelogd</th><th>Actief</th></tr></thead>
        <tbody>
        @foreach($users as $user)
            {{$user}}
            <tr><td>{{$user->name}}</td><td>{{$user->email}}</td><td>{{$user->knsb_id}}</td><td>{{$user->rating}}</td><td>{{$user->beschikbaar}}</td><td>{{$user->firsttimelogin}}</td><td>{{$user->active}}</td></tr>
        @endforeach
        </tbody>
    </table>

</div>
