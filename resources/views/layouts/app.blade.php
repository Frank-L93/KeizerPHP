<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @auth
    @if(settings()->has('layout'))
        @if(settings()->get('layout') === 'app')
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @elseif(settings()->get('layout') === 'blue')
        <link href="{{ asset('css/blue.css') }}" rel="stylesheet">
       @endif
    @else    
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    @endauth
    @guest
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @endguest

    <!-- Editable -->
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script>
     $(document).ready(function(){
         setInterval(function(){
      $("#funky").load(window.location.href + " #funky" );
}, 10000);   
    });
    </script>

    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
</head>
<body>

    @include('inc.navbar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                @include('inc.messages')
                @yield('content')
            
            </div>
        
        </div>
    </div>
@auth
@if(settings()->has('notifications'))
    @if(settings()->get('notifications') == 2 OR settings()->get('notifications') == 3)
    <script src="{{ asset('js/enable-push.js') }}" defer></script>
    @endif
@endif
@endauth  
</body>

</html>

                      