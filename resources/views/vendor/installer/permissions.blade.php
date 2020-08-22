@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">    
    {{ trans('installer_messages.permissions.title') }}
    </div>
    <div class="card-body">
    <ul class="list-group">
        @foreach($permissions['permissions'] as $permission)
        <li class="list-group-item list-group-item-{{ $permission['isSet'] ? 'success' : 'danger' }}">
            <img src="/assets/icons/folder.svg" />
                {{ $permission['folder'] }}
            <span>
                <img src="/assets/icons/{{ $permission['isSet'] ? 'check.svg' : 'circle-slash.svg' }}" />
                {{ $permission['permission'] }}
            </span>
        </li>
        @endforeach
    </ul>

    @if ( ! isset($permissions['errors']))
       <p> <div class="btn-group" role="group" aria-label="pager">
            <a href="{{ route('LaravelInstaller::environmentWizard') }}" class="btn btn-primary">
                {{ trans('installer_messages.permissions.next') }}
                <img src="/assets/icons/chevron-right.svg" />
            </a>
        </div>
    </p>
    @endif
    </div>
</div>
@endsection
