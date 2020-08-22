@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">
		{{ trans('installer_messages.final.title') }}
	</div>
	<div class="card-body">
	@if(session('message')['dbOutputLog'])
		<p><strong><small>{{ trans('installer_messages.final.migration') }}</small></strong></p>
		<pre><code>{{ session('message')['dbOutputLog'] }}</code></pre>
	@endif

	<p><strong><small>{{ trans('installer_messages.final.console') }}</small></strong></p>
	<pre><code>{{ $finalMessages }}</code></pre>

	<p><strong><small>{{ trans('installer_messages.final.log') }}</small></strong></p>
	<pre><code>{{ $finalStatusMessage }}</code></pre>

	<p><strong><small>{{ trans('installer_messages.final.env') }}</small></strong></p>
	<pre><code>{{ $finalEnvFile }}</code></pre>
	<p> <div class="btn-group" role="group" aria-label="pager">
	<a href="{{ route('LaravelInstaller::admin') }}" class="btn btn-primary">
		{{ trans('installer_messages.final.next') }}
		<img src="/assets/icons/chevron-right.svg" />
	</a>
</div></p>
</div>
@endsection
