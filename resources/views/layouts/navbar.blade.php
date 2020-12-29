<nav
    class="bg-white border-b-2 border-gray-600 sm:border-b-0 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

    <div class="flex flex-wrap items-center">
        <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-black">
            @if(Request::is('*install*'))
            <span class="text-xl pl-2">KeizerPHP</span>
            @else
            <!-- Normal -->
            <a class="text-xl pl-2" href="/">{{config('app.name', 'KeizerPHP')}}</a>
            @endif
        </div>

        <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
            <span class="relative w-full">

            </span>
        </div>

        <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
            <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                <x-menu-item link="/">Home</x-menu-item>
                <x-menu-item link="/about">{!!
                    trans('pages.about.header') !!}</x-menu-item>

                @guest

                <x-menu-item link="{{ route('login') }}">{{ __('Login') }}</x-menu-item>
                @else
                <div x-data="{open: false}" class="relative">
                    <button x-on:click="open = true"
                        class="bg-transparent border border-blue-500  mt-1 block px-2 py-1 font-semibold hover:bg-gray-200 hover:border-transparent sm:mt-0 sm:ml-2">
                        {{ Auth::user()->name }}
                    </button>
                    <div x-show.transition="open" x-on:click.away="open = false"
                        class="absolute z-10 mt-2 py-2 w-48 bg-white -lg shadow-xl">
                        @if(Auth::user()->can('admin'))
                        <a class="mt-1 block px-2 py-1  font-semibold hover:bg-gray-200 sm:mt-0 sm:ml-2"
                            href="/admin">{!!
                            trans('pages.index.admin') !!}
                        </a>
                        @endif
                        <a class="mt-1 block px-2 py-1  font-semibold hover:bg-gray-200 sm:mt-0 sm:ml-2"
                            href="/settings">{!!
                            trans('pages.index.settings') !!}</a>
                        <a class="mt-1 block px-2 py-1  font-semibold hover:bg-gray-200 sm:mt-0 sm:ml-2"
                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Log Uit') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <div x-data="{inbox: false}" clas="relative">
                    <button x-on:click="inbox = true"
                        class="sm:ml-2 py-4 px-6 relative  border-transparent text-gray-800 rounded-full hover:text-gray-400 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out"
                        style="background-image: url('/assets/icons/inbox.svg'); background-repeat: no-repeat; background-size: 25px 40px;">
                        <span class="absolute inset-0 object-right-top -mr-2">
                            <div
                                class="inline-flex items-center px-1.5 py-0.5 border-2 border-white rounded-full text-xs font-semibold leading-4 bg-red-500 text-white">
                                {{auth()->user()->unReadNotifications->count()}}
                            </div>
                        </span>
                    </button>
                    <div x-show.transition="inbox" x-on:click.away="inbox = false"
                        class="absolute z-50 right-0 mt-2 py-2 w-48 bg-white -lg shadow-xl">
                        <ul>
                            @if(auth()->user()->unReadNotifications->count() > 0)<li
                                class="block py-2 px-6 mb-0 text-sm text-gray-800 whitespace-no-wrap"><a
                                    href="{{route('readNotifications')}}">Markeer als gelezen</a></li>
                            @foreach(auth()->user()->unReadNotifications->take(5) as $notification)
                            <li class="block py-2 px-6 mb-0 text-sm text-gray-800 whitespace-no-wrap">
                                <h5>{{$notification->data['Title']}}</h5>
                                <hr>{{$notification->data['Message']}}
                            </li>
                            @endforeach
                            @else
                            <li class="block py-2 px-6 mb-0 text-sm text-gray-800 whitespace-no-wrap">Je hebt geen
                                meldingen
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endguest
                <div x-data="{lang: false}" class="relative">
                    <button x-on:click="lang = true" class="sm:ml-2 py-4 px-6 relative  border-transparent text-gray-800 rounded-full hover:text-gray-400 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out" style="background-image: url('/assets/{{session('locale')}}.svg'); background-repeat: no-repeat; background-size: 25px 40px;">

                    </button>
                    <div x-show.transition="lang" x-on:click.away="lang = false" class="absolute ml-2 mt-1 z-10 w-6 shadow-2xl">
                        <a class="mt-1 block hover:bg-gray-200" href="/lang/nl"><img src="assets/nl.svg"/></a>
                        <a class="mt-1 block hover:bg-gray-200" href="/lang/en"><img src="assets/en.svg"/></a>
                    </div>
                </div>
            </ul>
        </div>
    </div>

</nav>
