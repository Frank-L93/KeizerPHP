@extends('layouts.app')

@section('content')
@auth    
    <div class="card text-black bg-light mb-3">
       
        <div class="card-header text-center">
            Partij</div>
            <div class="card-body">
            {!! Form::open(['action' => 'AdminController@storePresence', 'method' => 'POST']) !!}
                <label for="player">Naam</label>
                <select id="player" name="player">
                    @foreach($players as $player)
                    <option value="{{$player->id}}">{{$player->name}}</option>
                    @endforeach
                </select>
                <label for="round">Ronde</label>
                <select id="round" name="round">
                    @foreach($rounds as $round)
                    <option value="{{$round->round}}">{{Carbon\Carbon::parse($round->date)->format('j F Y')}}</option>
                    @endforeach
                </select><br>
                <label for="reason">Reden (alleen invullen als afwezig)</label><br>
                <select name="reason" class="form-control">
                    <option value="Empty"></option>
                    <option value="Club">Avondcompetitie of Beker</option>
                    <option value="Personal">Ziek, Persoonlijke reden, bekend bij Wedstrijdleider</option>
                    <option value="Other">Anders</option>
                </select>
                <label for="presence">Aanwezigheid</label><br>
                <div class="btn-group btn-group-lg mr-2" role="group" aria-label="chooser">
                    <button name="presence" type="submit" value="0" class="btn btn-danger form-control">Afwezig</button>
                    <button name="presence" type="submit" value="1" class="btn btn-success form-control">Aanwezig</button>
                </div>
                {!! Form::close() !!}
             </div>

    </div>   

@endauth 
@endsection