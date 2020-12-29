@extends('layouts.app')

@section('content')
<x-card-header>
        {!! trans('pages.about.header') !!}
</x-card-header>
    <x-card-body>
        <div x-data="{ accordion: 0 }">
            <x-accordion accordionID="1" title="{!! trans('pages.about.privacyT') !!}">
                <x-grid cols="2">
                    <x-grid-card color="green" title="{!! trans('pages.about.privacyCardTitle') !!}" content="{!! trans('pages.about.privacyContent') !!}"></x-grid-card>
                    <x-grid-card color="orange" title="{!! trans('pages.about.sourceCardTitle') !!}" content="{!! trans('pages.about.sourceContent') !!}"></x-grid-card>
                </x-grid>
            </x-accordion>
            <x-accordion accordionID="2" title="{!! trans('pages.about.helpT') !!}">
                <x-grid cols="1">
                <x-grid-card color="blue" title="{!! trans('pages.about.helpCardTitle') !!}" content="{!! trans('pages.about.helpContent') !!}"></x-grid-card>
                </x-grid></x-accordion>
            <x-accordion accordionID="3" title="{!! trans('pages.about.builtT') !!}" text="{!! trans('pages.about.built') !!}">
                <x-grid cols="4">
                    <x-grid-card color="orange" title="" content="{!! trans('pages.about.laravel') !!}"></x-grid-card>
                    <x-grid-card color="blue" title="" content="{!! trans('pages.about.livewire') !!}"></x-grid-card>
                    <x-grid-card color="green" title="" content="{!! trans('pages.about.tailwind') !!}"></x-grid-card>
                    <x-grid-card color="yellow" title="" content="{!! trans('pages.about.jetbrains') !!}"></x-grid-card>
                </x-grid>
            </x-accordion>
        </div>
    </x-card-body>
<x-card-footer>{!! trans('pages.about.copyright') !!}</x-card-footer>
@endsection
