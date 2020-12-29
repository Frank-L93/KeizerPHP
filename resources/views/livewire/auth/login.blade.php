<div>
    <x-card-header>
        {!! trans('auth.header') !!}
    </x-card-header>
    <x-card-body>
        <form wire:submit.prevent="authenticate">
            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                    {!! trans('auth.email') !!}
                </label>

                <div class="mt-1 rounded-md shadow-sm">
                    <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" />
                </div>

                @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                    {!! trans('auth.password') !!}
                </label>

                <div class="mt-1 rounded-md shadow-sm">
                    <input wire:model.lazy="password" id="password" type="password" required
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" />
                </div>

                @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <x-button class="md:w-1/2 px-3 mb-6 md:mb-0" type="submit" value="" name="" success="green">
                    {!! trans('auth.signin') !!}
                </x-button>
                <a href="{{ route('password.request') }}"
                    class="font-medium text-gray-900 hover:text-gray-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    {!! trans('auth.forgotten') !!}
                </a>
            </div>
        </form>
    </x-card-body>
    <x-card-footer></x-card-footer>
</div>
