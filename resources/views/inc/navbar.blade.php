<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">{{config('app.name', 'De Pion')}}</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="/">Dashboard</a>
      <a class="p-2 text-dark" href="/about">Over</a>
    </nav>
    <!-- Authentication Links -->
    @guest
        <a class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
    
    @else
     <a class="p-2 text-dark" href="#"  v-pre>
            {{ Auth::user()->name }}
    </a>
    
           <div id="funky"> <a class="p-2 dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                <span class="glyphicon glyphicon-bell"></span>@if(auth()->user()->unReadNotifications->count() > 0)<span class="badge badge-light">{{auth()->user()->unReadNotifications->count()}}</span>@endif
            </a>
            <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
            @if(auth()->user()->unReadNotifications->count() > 0)<li class="dropdown-header"><a href="{{route('readNotifications')}}" >Markeer als gelezen</a></li>
            @foreach(auth()->user()->unReadNotifications->take(5) as $notification)
                <li class="dropdown-header"><h5>{{$notification->data['Title']}}</h5><hr>{{$notification->data['Message']}}</li>
                @endforeach
            @else
            <li class="dropdown-header">Je hebt geen meldingen</li>
            @endif
            </ul>
            </div>
    <a class="btn btn-outline-primary" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Log Uit') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
       
    @endguest
  </div>
  