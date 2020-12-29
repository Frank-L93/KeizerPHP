@section('content')
<x-card-header>
    {!! trans('pages.presences.header') !!}
</x-card-header>
<x-card-body>
    <form wire:submit.prevent="confirm">
        <label for="date">{!! trans('pages.main.Round') !!}</label>
        <select multiple
            class="block appearance-none w-1/3 py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
            @foreach($rounds as $round)
            <option value="{{$round->id}}">
                {{Date::parse($round->date)->locale(App::getLocale())->format('j M Y')}}</option>
            @endforeach
        </select>
        <div>
            {{$show}}
            <x-button wire:model="show" name="absent" value="" type="submit" success="red">{!!
                trans('pages.presences.absent') !!}</x-button>
            <x-button name="present" value="submit" type="button" success="green" wire:click="present">{!!
                trans('pages.presences.present') !!}</x-button>
        </div>
        <div class="{{$show}}">
            <label for="reason">{!! trans('pages.presences.reason') !!}</label><br>
            <select wire:model.lazy="reason" id="reason" name="reason"
                class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                <option value="Empty"></option>
                <option value="Other">{!! trans('pages.presences.other') !!}</option>
                <option value="Club">{!! trans('pages.presences.club') !!}</option>
                <option value="Personal">{!! trans('pages.presences.personal') !!}
                </option>
            </select>
        </div>
        <div>
        </div>
    </form>
</x-card-body>
<x-card-footer>
</x-card-footer>