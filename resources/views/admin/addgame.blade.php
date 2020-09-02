@extends('layouts.app')

@section('content')
@auth    
    <div class="card text-black bg-light mb-3">
       
        <div class="card-header text-center">
            Partij</div>
            <div class="card-body">
            {!! Form::open(['action' => 'AdminController@storeGame', 'method' => 'POST']) !!}
                <label for="white">Wit</label>
                <select id="white" name="white">
                    @foreach($players as $player)
                    <option value="{{$player->id}}">{{$player->name}}</option>
                    @endforeach
                </select>
                <label for="black">Zwart</label>
                <select id="black" name="black">
                    @foreach($players as $player)
                    <option value="{{$player->id}}">{{$player->name}}</option>
                    @endforeach
                </select>
                <label for="round"></label><br>
                    <div class="btn-group btn-group-lg mr-2" role="group" aria-label="chooser">            
                        <button id="round" name="round" type="submit" value="{{$round}}" class="btn btn-success form-control">Voeg partij toe aan ronde {{$round}}</button>
                    </div>
                {!! Form::close() !!}
             </div>

    </div>   

@endauth 
@endsection
