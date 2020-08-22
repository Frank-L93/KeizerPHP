@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">    
    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.requirements.title') }}
    </div>
    <div class="card-body">
    @foreach($requirements['requirements'] as $type => $requirement)
        <ul class="list-group">
            <li class="list-group-item list-group-item-{{ $phpSupportInfo['supported'] ? 'success' : 'danger' }}">
                <strong>{{ ucfirst($type) }}</strong>
                @if($type == 'php')
                    <strong>
                        <small>
                            (version {{ $phpSupportInfo['minimum'] }} required)
                        </small>
                    </strong>
                    <span class="float-right">
                        <strong>
                            {{ $phpSupportInfo['current'] }}
                        </strong>
                        <img src="/assets/icons/{{ $phpSupportInfo['supported'] ? 'check.svg' : 'circle-slash.svg' }}"/>
                    </span>
                @endif
            </li>
            @foreach($requirements['requirements'][$type] as $extention => $enabled)
                <li class="list-group-item list-group-item-action list-group-item-{{ $enabled ? 'success' : 'danger' }}">
                    {{ $extention }}
                    <img src="/assets/icons/{{ $enabled ? 'check.svg' : 'circle-slash.svg' }}" />
                </li>
            @endforeach
        </ul>
    @endforeach
    @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] )
       <p> <div class="btn-group" role="group" aria-label="pager">
            <a class="btn btn-primary" href="{{ route('LaravelInstaller::permissions') }}">
                {{ trans('installer_messages.requirements.next') }}
                <img src="/assets/icons/chevron-right.svg" />
            </a>
        </div>
    </p>
    @endif
    </div>
</div>
@endsection