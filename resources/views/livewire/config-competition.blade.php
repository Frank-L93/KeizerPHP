<div>
    @foreach($configs as $index => $config)
        <form wire:submit.prevent="save">
        <div wire:key="config-field-{{$config->id}}">
            <div x-data="{ accordion: 0 }">
                <x-accordion accordionID="1" title="{!! trans('admin.competition.1') !!}">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6 ">
                            <x-form-input label="RoundsBetween_Bye" type="number" original="configs.{{$index}}.RoundsBetween_Bye">
                                {!! trans('admin.competition.2') !!}
                            </x-form-input>
                            <x-form-input label="RoundsBetween" type="number" original="configs.{{$index}}.RoundsBetween">
                                {!! trans('admin.competition.3') !!}
                            </x-form-input>
                            <x-form-input label="AbsenceMax" type="number" original="configs.{{$index}}.AbsenceMax">
                                {!! trans('admin.competition.4') !!}
                            </x-form-input>
                        </div>
                    </div>
                </x-accordion>
                <x-accordion accordionID="2" title="{!! trans('admin.competition.5') !!}">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6 ">
                <x-form-input label="Club" type="number" original="configs.{{$index}}.Club">
                    {!! trans('admin.competition.6') !!}
                </x-form-input>
                <x-form-input label="Bye" type="number" original="configs.{{$index}}.Bye">
                    {!! trans('admin.competition.7') !!}
                </x-form-input>
                <x-form-input label="Personal" type="number" original="configs.{{$index}}.Personal">
                    {!! trans('admin.competition.8') !!}
                </x-form-input>
                <x-form-input label="Other" type="number" original="configs.{{$index}}.Other">
                    {!! trans('admin.competition.9') !!}
                </x-form-input>
                <x-form-input label="Presence" type="number" original="configs.{{$index}}.Presence">
                    {!! trans('admin.competition.10') !!}
                </x-form-input>
                        </div></div>
                </x-accordion>
                <x-accordion accordionID="3" title="{!! trans('admin.competition.11') !!}">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6 ">
                <x-form-input label="Start" type="number" original="configs.{{$index}}.Start">
                    {!! trans('admin.competition.12') !!}
                </x-form-input>
                <x-form-input label="Step" type="number" original="configs.{{$index}}.Step">
                    {!! trans('admin.competition.13') !!}
                </x-form-input>
                        </div></div>
                </x-accordion>
                <x-accordion accordionID="4" title="{!! trans('admin.competition.14') !!}">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6 ">
                <x-form-input label="Season" type="text" original="configs.{{$index}}.Season">
                    {!! trans('admin.competition.15') !!}
                </x-form-input>
                <x-form-input label="SeasonPart" type="number" original="configs.{{$index}}.SeasonPart">
                    {!! trans('admin.competition.16') !!}
                </x-form-input>
                <x-form-input label="EndSeason" type="number" original="configs.{{$index}}.EndSeason">
                    {!! trans('admin.competition.17') !!}
                </x-form-input>
                        </div></div>
                </x-accordion>
                <x-accordion accordionID="5" title="{!! trans('admin.competition.18') !!}">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6 ">
                <x-form-input label="Name" type="text" original="configs.{{$index}}.Name">
                    {!! trans('admin.competition.19') !!}
                </x-form-input>
                <x-form-input label="announcement" type="text" original="configs.{{$index}}.announcement">
                    {!! trans('admin.competition.20') !!}
                </x-form-input>
                <x-form-input label="Admin" type="number" original="configs.{{$index}}.Admin">
                    {!! trans('admin.competition.21') !!}
                </x-form-input>
                        </div></div>
                </x-accordion>
            </div>
        </div>
            <button class="bg-green-400 rounded-md shadow-xl text-white text-xs m-1 inline-flex px-2 py-2 hover:bg-green-600" type="submit">{!! trans('admin.competition.22') !!}</button>
        </form>
    @endforeach

</div>
