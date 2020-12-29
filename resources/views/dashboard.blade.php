@extends('layouts.app')

@section('content')
    <!-- Tutorial -->

    @if(session()->has('firstTime'))
        @if(session()->get('firstTime') === '1')
            @if(Auth::user()->can('admin'))
                <x-grid cols="2">
                    <x-grid-card color="orange" title="{!! trans('pages.dashboard.introTitle') !!}" content="{!! trans('pages.dashboard.intro') !!}"></x-grid-card>
                    <x-grid-card color="blue" title="{!! trans('pages.dashboard.helpTitle') !!}" content="{!! trans('pages.dashboard.help') !!}"></x-grid-card>
                </x-grid>

                @endif
            @endif
    @endif
        <!-- The Dashboard -->
@livewire('dashboard')
@endsection
