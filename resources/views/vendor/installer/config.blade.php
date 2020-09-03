@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        {!! trans('installer_messages.configs.title') !!}
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('LaravelInstaller::saveConfigs') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.competition') !!}</label>
                        <div class="col-md-6">
                            <input id="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.season') !!}</label>
                        <div class="col-md-6">
                            <input id="Season" type="text" class="form-control" value="" required name="Season">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.endseason') !!}</label>
                        <div class="col-md-6">
                            <input id="EndSeason" type="number" step="1" max="1" min="0" name="EndSeason" class="form-control" value="" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.start') !!}</label>
                        <div class="col-md-6">
                            <input id="Start" type="number" name="Start" class="form-control" value="" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.step') !!}</label>
                            <div class="col-md-6">
                                <input id="Step" type="number" name="Step" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.between') !!}</label>
                            <div class="col-md-6">
                                <input id="RoundsBetween" type="number" name="RoundsBetween" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.betweenBye') !!}</label>
                            <div class="col-md-6">
                                <input id="RoundsBetween_Bye" type="number" name="RoundsBetween_Bye" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.absenceMax') !!}</label>
                            <div class="col-md-6">
                                <input id="AbsenceMax" type="number" name="AbsenceMax" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.seasonPart') !!}</label>
                            <div class="col-md-6">
                                <input id="SeasonPart" type="number" name="SeasonPart" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.Bye') !!}</label>
                            <div class="col-md-6">
                                <input type="number" name="Bye" step="0.0001" max="1" min="0" id="Bye" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.Presence') !!}</label>
                            <div class="col-md-6">
                                <input type="number" name="Presence" step="0.0001" max="1" min="0" id="Presence" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.Club') !!}</label>
                            <div class="col-md-6">
                                <input type="number" name="Club" step="0.0001" max="1" min="0" id="Club" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.Personal') !!}</label>
                            <div class="col-md-6">
                                <input type="number" name="Personal" step="0.0001" max="1" min="0" id="Personal" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.Other') !!}</label>
                            <div class="col-md-6">
                                <input type="number" name="Other" step="0.0001" max="1" min="0" id="Other" class="form-control" value="" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.configs.Admin') !!}</label>
                            <div class="col-md-6">
                                <input type="number" name="Admin" step="1" min="0" id="Admin" class="form-control" value="1" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                <p>
                    <div class="btn-group col-md-6" role="group" aria-label="submit">
                        <button class="btn btn-success mr-4" type="submit">
                            {!! trans('installer_messages.configs.save') !!}
                            <img src="/assets/icons/chevron-right.svg" />
                        </button>
                    </div>
                </p>
                </form>
            </div>
            

    </div>

    <script type="text/javascript">
        function checkEnvironment(val) {
            var element=document.getElementById('environment_text_input');
            if(val=='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }
    </script>
    </div>
</div>
@endsection
