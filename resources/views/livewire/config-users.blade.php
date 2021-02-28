<div x-data="{}">
    <table class="w-full max-w-full mb-4 table-auto">
        <thead class="table-header-group bg-black text-white">
        <tr>
            <th>{!! trans('admin.users.name') !!}</th>
            <th>{!! trans('admin.users.email') !!}</th>
            <th>{!! trans('admin.users.knsb') !!}</th>
            <th>{!! trans('admin.users.rating') !!}</th>
            <th>{!! trans('admin.users.available') !!}</th>
            <th>{!! trans('admin.users.firsttime') !!}</th>
            <th>{!! trans('admin.users.active') !!}</th>
            <th>{!! trans('admin.users.edit') !!}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="table-row border-cool-gray-500 border-b">
                <td class="table-cell pb-2 text-center">
                    @if($editedUserIndex === $user->id || $editedUserField === $user->id . '.name')
                        <input type="text" @click.away="$wire.editedUserField === '{{$user->id}}.name' ? $wire.saveUser({{$user->id}}) : null" value="{{$user->name}}"
                        class="appearance-none block w-1/2 bg-grey-lighter text-grey-darker border border-red rounded py-1 px-4 mb-3">
                    @else
                        <div class="cursor-pointer" wire:click="editUserField({{$user->id}}, 'name')">
                        {{$user->name}}
                        </div>
                    @endif
                </td>
                <td class="table-cell pb-2 text-center">@if($editedUserIndex === $user->id || $editedUserField === $user->id . '.email')
                        <input type="email" @click.away="$wire.editedUserField === '{{$user->id}}.email' ? $wire.saveUser({{$user->id}}) : null" value="{{$user->email}}"
                               class="appearance-none block w-1/2 bg-grey-lighter text-grey-darker border border-red rounded py-1 px-4 mb-3">
                    @else
                        <div class="cursor-pointer" wire:click="editUserField({{$user->id}}, 'email')">
                            {{$user->email}}
                        </div>
                    @endif</td>
                <td class="table-cell pb-2 text-center">@if($editedUserIndex === $user->id || $editedUserField === $user->id . '.knsb_id')
                        <input type="number" @click.away="$wire.editedUserField === '{{$user->id}}.knsb_id' ? $wire.saveUser({{$user->id}}) : null" value="{{$user->knsb_id}}"
                               class="appearance-none block w-1/2 bg-grey-lighter text-grey-darker border border-red rounded py-1 px-4 mb-3">
                    @else
                        <div class="cursor-pointer" wire:click="editUserField({{$user->id}}, 'knsb_id')">
                            {{$user->knsb_id}}
                        </div>
                    @endif</td>
                <td class="table-cell pb-2 text-center">@if($editedUserIndex === $user->id || $editedUserField === $user->id . '.rating')
                        <input type="number" @click.away="$wire.editedUserField === '{{$user->id}}.rating' ? $wire.saveUser({{$user->id}}) : null" value="{{$user->rating}}"
                               class="appearance-none block w-1/2 bg-grey-lighter text-grey-darker border border-red rounded py-1 px-4 mb-3">
                    @else
                        <div class="cursor-pointer" wire:click="editUserField({{$user->id}}, 'rating')">
                            {{$user->rating}}
                        </div>
                    @endif</td>
                <td class="table-cell pb-2 text-center">
                    @if($user->beschikbaar == 0)
                        {!! trans('admin.users.no') !!}
                    @else
                        {!! trans('admin.users.yes') !!}
                    @endif
                </td>
                <td class="table-cell pb-2 text-center">
                    @if($user->firsttimelogin == 0)
                        {!! trans('admin.users.no') !!}
                    @else
                        {!! trans('admin.users.yes') !!}
                    @endif
                </td>
                <td class="table-cell pb-2 text-center">
                    @if($user->active == 0)
                        {!! trans('admin.users.no') !!}
                    @else
                        {!! trans('admin.users.yes') !!}
                    @endif
                </td>
                <td class="table-cell pb-2 text-center">
                    @if($editedUserIndex == $user->id)
                        <i class="fas fa-save"></i>
                    @else
                        <i wire:click="editUserRow({{$user->id}})" class="fas fa-pen"></i>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
</div>
