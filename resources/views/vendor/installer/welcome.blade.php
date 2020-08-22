@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    {{ trans('installer_messages.welcome.title') }}
  </div>
  <div class="card-body">
    <p class="text-center">
      {{ trans('installer_messages.welcome.message') }}
    </p>
    <p class="text-center">
      <a href="{{ route('LaravelInstaller::requirements') }}" class="button">
        {{ trans('installer_messages.welcome.next') }}
        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
      </a>
    </p>
  </div>
</div>
@endsection   
