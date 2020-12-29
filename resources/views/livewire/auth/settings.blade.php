@section('content')
<div>
    <x-card-header>
        {!! trans('pages.settings.header') !!}
    </x-card-header>
    <!-- End Head -->
    <!-- Content -->
    <x-card-body>
        <x-settings-form>
            <!-- Password Content -->
            <div>
                <x-card-header>
                    {!! trans('pages.settings.password') !!}
                </x-card-header>
                <x-card-body>
                    <form wire:submit.prevent="changePassword">
                        {{ csrf_field() }}
                        <div class="mb-4">
                            <label for="password" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.currentPassword') !!}</label>
                            <div class="">
                                <input wire:model.lazy="password" id="password" type="password"
                                    class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border"
                                    required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="newPassword" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.newPassword') !!}</label>
                            <div class="">
                                <input wire:model="newPassword" id="newPassword" type="password"
                                    class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border"
                                    required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="passwordConfirmation"
                                class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.newPassword2') !!}</label>
                            <div class="">
                                <input wire:model.lazy="passwordConfirmation" id="passwordConfirmation" type="password"
                                    class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border"
                                    required>
                            </div>
                        </div>
                        <div class="mt-6">
                            <span class="block  rounded-md shadow-sm">
                                <button type="submit"
                                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    {!! trans('pages.settings.button') !!}
                                </button>
                            </span>
                        </div>
                    </form>
                </x-card-body>
                <x-card-footer></x-card-footer>
            </div>
            <div>
                <x-card-header>
                    {!! trans('pages.settings.email') !!}
                </x-card-header>
                <x-card-body>
                    <form wire:submit.prevent="changeEmail">
                        {{ csrf_field() }}
                        <div class="mb-4">
                            <label for="email" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.email') !!}</label>
                            <div class="">
                                <input wire:model.lazy="email" type="email" id="email" placeholder="{{$email}}"
                                    class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.password') !!}</label>
                            <div class="">
                                <input wire:model.lazy="emailPassword" type="password" id="emailPassword"
                                    class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border" />
                            </div>
                        </div>
                        <div class="mt-6">
                            <span class="block  rounded-md shadow-sm">
                                <button type="submit"
                                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    {!! trans('pages.settings.button') !!}
                                </button>
                            </span>
                        </div>
                    </form>
                </x-card-body>
                <x-card-footer></x-card-footer>
            </div>
            <div>
                <x-card-header>
                    {!! trans('pages.settings.preferences') !!}
                </x-card-header>
                <x-card-body>
                    <form class="form-horizontal" wire:submit.prevent="changeSettings">

                        <div class="mb-4">
                            <label for="games" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.games') !!}</label>
                            <select wire:model="games" id="games" name="games"
                                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border">
                                @foreach($gameOptions as $key => $value)
                                <option value="{{ $key }}" wire:key="{{$key}}">
                                    {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="ranking" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.ranking') !!}</label>
                            <select wire:model="ranking" id="ranking" name="ranking"
                                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border">
                                @foreach($rankingOptions as $key => $value)
                                <option value="{{ $key }}" wire:key="{{$key}}">
                                    {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div x-data="{'showModal': false}" @@keydown.escape="showModal = false" class="mb-4">
                            <label for="notifications" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.notifications') !!}
                                <button type="button"
                                    class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded-full py-1 px-3 bg-teal-500 text-white hover:bg-teal-600"
                                    @@click="showModal = !showModal">?</button>
                                @livewire('modal', ['type' => 'notifications'])
                            </label>
                            <select wire:model="notifications" id="notifications" name="notifications"
                                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border">
                                @foreach($notificationOptions as $key => $value)
                                <option value="{{ $key }}" wire:key="{{$key}}">
                                    {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="rss" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.rss') !!}</label>
                            <select wire:model="rss" id="rss" name="rss"
                                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border">
                                @foreach($rssOptions as $key => $value)
                                <option value="{{ $key }}" wire:key="{{$key}}">
                                    {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            @if($user->api_token !== NULL)
                            <label for="rss-link" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.rsslink') !!}</label>
                            <input wire:model="rss_link" id="rss_link"
                                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border"
                                type="text" value="https://interndepion.nl/feed/{{$rss_link}}" disabled>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label for="layout" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.layout') !!}</label>
                            <select wire:model="layout" id="layout" name="layout"
                                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border">
                                @foreach($layoutOptions as $key => $value)
                                <option value="{{ $key }}" wire:key="{{$key}}">
                                    {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="language" class="block text-sm leading-5 font-medium text-gray-700">{!!
                                trans('pages.settings.language') !!}</label>
                            <select wire:model="language" id="language" name="language"
                                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 shadow-sm rounded-full border-gray-800 border">
                                @foreach($languageOptions as $key => $value)
                                <option value="{{ $key }}" wire:key="{{$key}}">
                                    {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-6">
                            <span class="block  rounded-md shadow-sm">
                                <button type="submit"
                                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md hover:bg-green-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    {!! trans('pages.settings.button') !!}
                                </button>
                            </span>
                        </div>
                    </form>
                </x-card-body>
                <x-card-footer></x-card-footer>
            </div>
        </x-settings-form>
    </x-card-body>
    <x-card-footer></x-card-footer>
</div>