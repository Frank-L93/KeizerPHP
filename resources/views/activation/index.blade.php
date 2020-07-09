@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card text-black bg-light mb-3">
        <div class="card-body">
            <div class="card">
                <div class="card-header">Activatie</div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('sendActivation') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mailadres</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                <button type="submit" class="btn btn-primary">
                                    Stuur Activatiemail
                                </button>

                    </form>
                    </div>
                </div>
            <div class="card">
                <div class="card-header">Activeer</div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('postActivation') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mailadres</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="activate" class="col-md-4 col-form-label text-md-right">Activatiecode</label>

                            <div class="col-md-6">
                                <input id="activate" type="number" class="form-control" name="activate" value="" required autofocus>
                            </div>
                        </div>
                                <button type="submit" class="btn btn-primary">
                                    Activeer
                                </button>

                    </form>
                     </div>
                </div>
        </div>
        </div>
        </div>
    </div>
</div>
@endsection
