@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session()->has('errors') && $errors->first('activation_response'))
    <div class="alert alert-danger" role="alert">
        {!!$errors->first('activation_response')!!}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
