@auth


<div
    class="bg-white shadow-xl h-16 border-t-2 border-gray-600 sm:border-t-0 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 overflow-x-auto overflow-y-hidden">
    <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
        <!-- Content for User -->
        <ul class="list-reset flex flex-row md:flex-col text-center md:text-left">
            <x-sidebar-menu-item link="/presences" icon="stopwatch">
                {!!trans('pages.index.presences') !!}
            </x-sidebar-menu-item>
            <x-sidebar-menu-item link="/rankings" icon="trophy">
                {!!
                trans('pages.index.rankings') !!}
            </x-sidebar-menu-item>
            <x-sidebar-menu-item link="/games" icon="gamepad">{!!
                trans('pages.index.games') !!}
            </x-sidebar-menu-item>
            <x-sidebar-menu-item link="/settings" icon="user-cog">{!!
                trans('pages.index.settings') !!}
            </x-sidebar-menu-item>
            <x-sidebar-menu-item link="https://www.depion.nl" icon="chess-pawn">{!!
                trans('pages.index.link') !!}
            </x-sidebar-menu-item>
        </ul>
    </div>
</div>
@endauth