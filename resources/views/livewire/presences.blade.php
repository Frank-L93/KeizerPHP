@section('content')
<div>
    <x-card-header>
        {!! trans('pages.presences.header') !!}
        <a href="/presences/create"
            class="inline-flex justify-center py-1 px-2 text-white bg-blue-400 border border-transparent rounded-md hover:bg-blue-600 transition duration-150 ease-in-out">
            {!! trans('pages.presences.headerLink') !!}
        </a>
    </x-card-header>
    <x-card-body>

        <table class="w-full max-w-full mb-4 table-auto">
            <thead class="table-header-group bg-black text-white">
                <th>{!! trans('pages.presences.name') !!}</th>
                <th>{!! trans('pages.presences.round') !!}</th>
                <th>{!! trans('pages.presences.presence') !!}</th>
            </thead>
            @foreach($presences as $presence)
            <tr class="table-row border-cool-gray-500 border-b">
                <td class="table-cell pb-2 text-center">{{$presence->user->name}}</td>
                <td class="table-cell pb-2 text-center">{{$presence->round}}</td>
                <td class="table-cell pb-2 text-center">
                    @if($presence->presence == 0)
                    <a href="/presences/edit/{{$presence->id}}/present"
                        class="inline-flex justify-center px-1 text-sm text-white bg-red-500 border border-transparent rounded-md hover:bg-red-600 transition duration-150 ease-in-out">{!!
                        trans('pages.presences.absent') !!}</a>
                    @else
                    <a href="/presences/edit/{{$presence->id}}/absent"
                        class="inline-flex justify-center px-1 text-sm text-white bg-green-500 border border-transparent rounded-md hover:bg-green-600 transition duration-150 ease-in-out">{!!
                        trans('pages.presences.present') !!}
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {{$presences->links()}}
    </x-card-body>
    <x-card-footer>
    </x-card-footer>
</div>