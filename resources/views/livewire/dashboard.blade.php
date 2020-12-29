@if($rounds === "Geen rondes meer!")
<x-card-header>
    {!! trans('pages.index.no_rounds') !!}
</x-card-header>
<x-card-body>
    @if($config->announcement === "")
    <span class="block shadow-md bg-red-600 rounded-md py-2 px-2 text-white text-sm">{!! trans('pages.index.helpno_rounds') !!}</span>
        @if(Auth::user()->can('admin'))<p>
            <span class="block shadow-md bg-yellow-300 rounded-md py-2 px-2 text-white text-sm">{!! trans('pages.index.adminAnnouncement') !!}</span>
        </p>@endif
    @else
        <span class="shadow-md bg-red-600 rounded-md py-2 px-2 text-white text-sm">{{$config->announcement}}</span>
    @endif
</x-card-body>
<x-card-footer></x-card-footer>

@else
<x-card-header>
    {!! trans('pages.index.dashboard') !!}
    @foreach($rounds as $round)
    @if(Carbon\Carbon::parse($round->date)->format('j M Y') === Carbon\Carbon::parse(now())->format('j M Y'))
    {!! trans('pages.main.Round') !!} {{$round->round}} | {!! trans('pages.index.today') !!}
    <?php $timediff = date_diff(Carbon\Carbon::parse($round->date), now()); if(Carbon\Carbon::parse($round->date) > now()){ echo "(over ".$timediff->h." uur, ".$timediff->i." minuten en ".$timediff->s." seconden)";}?>!
    @else
    {!! trans('pages.main.Round') !!} {{$round->round}} |
    {{Carbon\Carbon::parse($round->date)->format('j M Y')}}!
    @endif
    @endforeach
</x-card-header>
<x-card-body>
    <div class="flex flex-wrap -mx-1 overflow-hidden sm:-mx-2 md:-mx-3 lg:-mx-3 xl:-mx-4">
        <x-dashboard-menu-item>
            <div class="flex pr-4">
                <img src="/assets/icons/play.svg" class="object-center w-32 h-16" alt="" width="64" height="64">
            </div>
            <div class="flex-1">
                <p class="text-xs text-center sm:font-bold sm:text-base text-gray-500">{!!
                    trans('pages.index.games') !!}: {{$games->count()}}</p>
            </div>
        </x-dashboard-menu-item>
        <x-dashboard-menu-item>
            <div class="flex pr-4">
                <img src="/assets/icons/person-fill.svg" class="object-center w-32 h-16" alt="" width="64" height="64">
            </div>
            <div class="flex-1">

                <p class="text-xs text-center sm:font-bold sm:text-base text-gray-500">{!!
                    trans('pages.index.present') !!}: {{$presences->count()}}</p>
            </div>
        </x-dashboard-menu-item>
        <x-dashboard-menu-item>
            <div class="flex pr-4">
                <img src="/assets/icons/lock.svg" class="object-center w-32 h-16" alt="" width="64" height="64">
            </div>
            <div class="flex-1">
                <p class="text-xs text-center sm:font-bold sm:text-base text-gray-500">{!!
                    trans('pages.index.absent_dashboard') !!}: {{$absences->count()}}</p>
            </div>
        </x-dashboard-menu-item>
    </div>
</x-card-body>

<x-card-footer></x-card-footer>
@endif
