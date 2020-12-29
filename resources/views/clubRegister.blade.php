@extends('layouts.app')

@section('content')
    <x-card-header>Register your club</x-card-header>
    <x-card-body>
        <form method="post" action="{{route('registerClub')}}">
            {{ csrf_field() }}
            <div class="mb-4">

        <label for="Club" class="block text-sm leading-5 font-medium text-gray-700">
            {!! trans('pages.register.name') !!}
            <input name="Club" type="text" class="form-input mb-2 mt-2 block w-1/2 pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border"/>
        </label>
            <label for="Contact" class="block text-sm leading-5 font-medium text-gray-700">
                {!! trans('pages.register.person') !!}
                <input name="Contact" type="text" class="form-input mb-2 mt-2 block w-1/2 pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border"/>
            </label>
            <label for="Email" class="block text-sm leading-5 font-medium text-gray-700">
                {!! trans('pages.register.mail') !!}
                <input name="Email" type="email" class="form-input mb-2 mt-2 block w-1/2 pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border" />
            </label>
                <label for="Password" class="block text-sm leading-5 font-medium text-gray-700">
                    {!! trans('pages.register.password') !!}
                    <input name="Password" type="password" class="form-input mb-2 mt-2 block w-1/2 pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border" />
                </label>

                <label for="KNSB" class="block text-sm leading-5 font-medium text-gray-700">
                    {!! trans('pages.register.id') !!}
                    <input name="KNSB" type="number" class="form-input mb-2 mt-2 block w-1/6 pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border" />
                </label>

                <label for="rating" class="block text-sm leading-5 font-medium text-gray-700">
                    {!! trans('pages.register.rating') !!}
                    <input name="rating" type="number" class="form-input mb-2 mt-2 block w-1/6 pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border" />
                </label>
            </div>
            <x-button name="submit" type="submit" success="green" value="submit">{!! trans('pages.register.button') !!}</x-button>
    </form>
    </x-card-body>
<x-card-footer></x-card-footer>
@endsection
