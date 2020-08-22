@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        {!! trans('installer_messages.admin.title') !!}
    </div>
    <div class="card-body">
                <form method="POST" action="{{ route('LaravelInstaller::registerAdmin') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.admin.name') !!}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="knsb_id" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.admin.id') !!}</label>

                        <div class="col-md-6">
                            <input id="knsb_id" type="number" class="form-control @error('knsb_id') is-invalid @enderror" name="knsb_id" value="{{ old('knsb_id') }}" required autocomplete="">

                            @error('knsb_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rating" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.admin.rating') !!}</label>

                        <div class="col-md-6">
                            <input id="rating" type="number" class="form-control @error('rating') is-invalid @enderror" name="rating" value="{{ old('rating') }}" required autocomplete="">

                            @error('rating')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                   <div class="form-group row">
                        <label for="beschikbaar" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.admin.available') !!}</label>

                        <div class="col-md-6">
                            <div class="form-check form-check-inline"><input type="radio" class="form-check-input" name="beschikbaar" value="1" id="beschikbaar1" checked>
                            <label class="form-check-label" for="beschikbaar1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="beschikbaar" value="0" id="beschikbaar2">
                            <label class="form-check-label" for="beschikbaar2">No</label>
                            </div>
                            @error('beschikbaar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.admin.email') !!}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.admin.password') !!}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right"> {!! trans('installer_messages.admin.confirm') !!}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    
        
                <p>
                    <div class="btn-group col-md-6" role="group" aria-label="submit">
                        <button class="btn btn-success mr-4" type="submit">
                            {!! trans('installer_messages.admin.register') !!}
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
