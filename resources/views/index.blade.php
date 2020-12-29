@extends('layouts.app')

@section('content')
<x-card-header>
    Welkom bij KeizerPHP
</x-card-header>
    <x-card-body>
        <x-grid cols="3">
            <x-grid-card title="" content="{!! trans('pages.front.intro') !!}" color="blue"></x-grid-card>
            <x-grid-card title="" content="{!! trans('pages.front.intro2') !!}" color="orange"></x-grid-card>
        <x-grid-card title="DEMO" content="{!! trans('pages.front.intro3') !!}" color="yellow"></x-grid-card>
        </x-grid>
    </x-card-body>
    <x-card-footer><a href="{{ route('clubRegister') }}" class="rounded shadow hover:shadow-md outline-none focus:outline-none uppercase font-bold px-4 py-2 bg-green-500 text-gray-800" >{!! trans('pages.front.button') !!}</a></x-card-footer>
@endsection
