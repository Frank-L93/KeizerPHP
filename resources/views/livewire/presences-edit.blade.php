@section('content')
@if($actionHandler < 3) <x-card>
    <x-card-header>
        {!! trans('pages.presences.header') !!}
    </x-card-header>
    <x-card-body>
        @if($actionHandler == 1)
        <form wire:submit.prevent="absent">
            <label for="date">{!! trans('pages.main.Round') !!}</label>
            <input type="text" name="date"
                value="{{Date::parse($presence->date->date)->locale(auth()->user()->settings()->language)->format('j M Y')}}"
                class="block w-1/6  py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                disabled>
            <div>
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
                <x-button name="submit" value="submit" type="submit" success="red">{!!
                    trans('pages.presences.absent') !!}</x-button>
            </div>
        </form>
        @elseif($actionHandler == 2)
        <form wire:submit.prevent="present">
            <label for="presence">{!! trans('pages.presences.labelPresent') !!}</label><br>

            <x-button name="presence" type="submit" value="1" success="green">{!!
                trans('pages.presences.present') !!}</x-button>

        </form>
        @endif
    </x-card-body>
    <x-card-footer>
        <button name="back" type="button" wire:click="goBack">{!! trans('pages.presences.back') !!}</button>
    </x-card-footer>
    </x-card>
    @endif
    @if($actionHandler == 3)
    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
        <p class="font-bold">{!! trans('pages.presences.process') !!}</p>
        <p>
            {!! trans('pages.presences.processExplain') !!}
        </p>
        <script>
            setTimeout(function () {
                                window.location.replace('{{ url('presences') }}');
                            }, 3000);
        </script>
    </div>
    @elseif($actionHandler == 4)
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
        <p class="font-bold">{!! trans('pages.presences.error') !!}</p>
        <p>
            {!! trans('pages.presences.errorExplain') !!}
        </p>
        <script>
            setTimeout(function () {
                                    window.location.replace('{{ url('presences') }}');
                                }, 3000);
        </script>
    </div>
    @endif