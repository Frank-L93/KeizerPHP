@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        {!! trans('installer_messages.environment.wizard.title') !!}
    </div>
    <div class="card-body">

        <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-header">
                    {{ trans('installer_messages.environment.wizard.tabs.environment') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                        <label for="app_name" class="col-md-4 control-label">
                            {{ trans('installer_messages.environment.wizard.form.app_name_label') }}
                        </label>
                        <input type="text" name="app_name" id="app_name" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_name_placeholder') }}" />
                        @if ($errors->has('app_name'))
                        <span class="error-block">
                            {{ $errors->first('app_name') }}
                        </span>
                        @endif
                        </div>

                        <div class="form-group {{ $errors->has('environment') ? ' has-error ' : '' }}">
                        <label for="environment" class="col-md-4 control-label">
                            {{ trans('installer_messages.environment.wizard.form.app_environment_label') }}
                        </label>
                        <select name="environment" id="environment" onchange='checkEnvironment(this.value);'>
                            <option value="local" selected>{{ trans('installer_messages.environment.wizard.form.app_environment_label_local') }}</option>
                            <option value="development">{{ trans('installer_messages.environment.wizard.form.app_environment_label_developement') }}</option>
                            <option value="qa">{{ trans('installer_messages.environment.wizard.form.app_environment_label_qa') }}</option>
                            <option value="production">{{ trans('installer_messages.environment.wizard.form.app_environment_label_production') }}</option>
                            <option value="other">{{ trans('installer_messages.environment.wizard.form.app_environment_label_other') }}</option>
                        </select>
                        <div id="environment_text_input" style="display: none;">
                            <input type="text" name="environment_custom" id="environment_custom" placeholder="{{ trans('installer_messages.environment.wizard.form.app_environment_placeholder_other') }}"/>
                        </div>
                        @if ($errors->has('app_name'))
                            <span class="error-block">
                                {{ $errors->first('app_name') }}
                            </span>
                        @endif
                        </div>

                        <div class="form-group {{ $errors->has('app_debug') ? ' has-error ' : '' }}">
                        <label for="app_debug" class="col-md-4 control-label">
                            {{ trans('installer_messages.environment.wizard.form.app_debug_label') }}
                        </label>
                        <label for="app_debug_true">
                        <input type="radio" name="app_debug" id="app_debug_true" value=true checked />
                            {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
                        </label>
                        <label for="app_debug_false">
                            <input type="radio" name="app_debug" id="app_debug_false" value=false/>
                            {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
                        </label>
                        @if ($errors->has('app_debug'))
                            <span class="error-block">
                            {{ $errors->first('app_debug') }}
                            </span>
                        @endif
                        </div>

                        <div class="form-group {{ $errors->has('app_log_level') ? ' has-error ' : '' }}">
                        <label for="app_log_level" class="col-md-4 control-label">
                            {{ trans('installer_messages.environment.wizard.form.app_log_level_label') }}
                        </label>
                        <select name="app_log_level" id="app_log_level">
                        <option value="debug" selected>{{ trans('installer_messages.environment.wizard.form.app_log_level_label_debug') }}</option>
                        <option value="info">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_info') }}</option>
                        <option value="notice">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_notice') }}</option>
                        <option value="warning">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_warning') }}</option>
                        <option value="error">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_error') }}</option>
                        <option value="critical">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_critical') }}</option>
                        <option value="alert">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_alert') }}</option>
                        <option value="emergency">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_emergency') }}</option>
                        </select>
                        @if ($errors->has('app_log_level'))
                        <span class="error-block">
                            {{ $errors->first('app_log_level') }}
                        </span>
                        @endif
                        </div>
                        <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                        <label for="app_url" class="col-md-4 control-label">
                            {{ trans('installer_messages.environment.wizard.form.app_url_label') }}
                        </label>
                        <input type="url" name="app_url" id="app_url" value="http://localhost" placeholder="{{ trans('installer_messages.environment.wizard.form.app_url_placeholder') }}" />
                        @if ($errors->has('app_url'))
                        <span class="error-block">
                            {{ $errors->first('app_url') }}
                        </span>
                        @endif
                        </div>

                        </div>
                </div>
                <div class="card">
                    <div class="card-header"> 
                        {{ trans('installer_messages.environment.wizard.tabs.database') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                            <label for="database_connection" class="col-md-4 control-label">
                                {{ trans('installer_messages.environment.wizard.form.db_connection_label') }}
                            </label>
                            <select name="database_connection" id="database_connection">
                                <option value="mysql" selected>{{ trans('installer_messages.environment.wizard.form.db_connection_label_mysql') }}</option>
                                <option value="sqlite">{{ trans('installer_messages.environment.wizard.form.db_connection_label_sqlite') }}</option>
                                <option value="pgsql">{{ trans('installer_messages.environment.wizard.form.db_connection_label_pgsql') }}</option>
                                <option value="sqlsrv">{{ trans('installer_messages.environment.wizard.form.db_connection_label_sqlsrv') }}</option>
                            </select>
                            @if ($errors->has('database_connection'))
                                <span class="error-block">
                                    {{ $errors->first('database_connection') }}
                                </span>
                            @endif
                        </div>
        
                        <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                            <label for="database_hostname" class="col-md-4 control-label">
                                {{ trans('installer_messages.environment.wizard.form.db_host_label') }}
                            </label>
                            <input type="text" name="database_hostname" id="database_hostname" value="147.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.db_host_placeholder') }}" />
                            @if ($errors->has('database_hostname'))
                                <span class="error-block">
                                    {{ $errors->first('database_hostname') }}
                                </span>
                            @endif
                        </div>
        
                        <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                            <label for="database_port" class="col-md-4 control-label">
                                {{ trans('installer_messages.environment.wizard.form.db_port_label') }}
                            </label>
                            <input type="number" name="database_port" id="database_port" value="3306" placeholder="{{ trans('installer_messages.environment.wizard.form.db_port_placeholder') }}" />
                            @if ($errors->has('database_port'))
                                <span class="error-block">
                                    {{ $errors->first('database_port') }}
                                </span>
                            @endif
                        </div>
        
                        <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                            <label for="database_name" class="col-md-4 control-label">
                                {{ trans('installer_messages.environment.wizard.form.db_name_label') }}
                            </label>
                            <input type="text" name="database_name" id="database_name" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_name_placeholder') }}" />
                            @if ($errors->has('database_name'))
                                <span class="error-block">
                                    {{ $errors->first('database_name') }}
                                </span>
                            @endif
                        </div>
        
                        <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                            <label for="database_username" class="col-md-4 control-label">
                                {{ trans('installer_messages.environment.wizard.form.db_username_label') }}
                            </label>
                            <input type="text" name="database_username" id="database_username" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_username_placeholder') }}" />
                            @if ($errors->has('database_username'))
                                <span class="error-block">
                                    {{ $errors->first('database_username') }}
                                </span>
                            @endif
                        </div>
        
                        <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                            <label for="database_password" class="col-md-4 control-label">
                                {{ trans('installer_messages.environment.wizard.form.db_password_label') }}
                            </label>
                            <input type="password" name="database_password" id="database_password" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_password_placeholder') }}" />
                            @if ($errors->has('database_password'))
                                <span class="error-block">
                                    {{ $errors->first('database_password') }}
                                </span>
                            @endif
                        </div>
        
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"> 
                        {{ trans('installer_messages.environment.wizard.tabs.application') }}
                    </div>
                    <div class="card-body">

                <div class="block">
                    <div class="info">
                        <div class="form-group {{ $errors->has('mail_driver') ? ' has-error ' : '' }}">
                            <label for="mail_driver" class="col-md-4 control-label">
                                {{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label') }}
                                <sup>
                                    <a href="https://laravel.com/docs/5.4/mail" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="mail_driver" id="mail_driver" value="smtp" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}" />
                            @if ($errors->has('mail_driver'))
                                <span class="error-block">
                                    {{ $errors->first('mail_driver') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_host') ? ' has-error ' : '' }}">
                            <label for="mail_host" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label') }}</label>
                            <input type="text" name="mail_host" id="mail_host" value="smtp.mailtrap.io" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}" />
                            @if ($errors->has('mail_host'))
                                <span class="error-block">
                                    {{ $errors->first('mail_host') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_port') ? ' has-error ' : '' }}">
                            <label for="mail_port" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label') }}</label>
                            <input type="number" name="mail_port" id="mail_port" value="4545" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}" />
                            @if ($errors->has('mail_port'))
                                <span class="error-block">
                                    {{ $errors->first('mail_port') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_username') ? ' has-error ' : '' }}">
                            <label for="mail_username" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label') }}</label>
                            <input type="text" name="mail_username" id="mail_username" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}" />
                            @if ($errors->has('mail_username'))
                                <span class="error-block">
                                    {{ $errors->first('mail_username') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_password') ? ' has-error ' : '' }}">
                            <label for="mail_password" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label') }}</label>
                            <input type="text" name="mail_password" id="mail_password" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}" />
                            @if ($errors->has('mail_password'))
                                <span class="error-block">
                                    {{ $errors->first('mail_password') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_from') ? ' has-error ' : '' }}">
                            <label for="mail_from" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_from_label') }}</label>
                            <input type="text" name="mail_from" id="mail_from" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_from_placeholder') }}" />
                            @if ($errors->has('mail_from'))
                                <span class="error-block">
                                    {{ $errors->first('mail_from') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_encryption') ? ' has-error ' : '' }}">
                            <label for="mail_encryption" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label') }}</label>
                            <input type="text" name="mail_encryption" id="mail_encryption" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}" />
                            @if ($errors->has('mail_encryption'))
                                <span class="error-block">
                                    {{ $errors->first('mail_encryption') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"> 
                        {{ trans('installer_messages.environment.wizard.tabs.application') }}
                    </div>
                    <div class="card-body">
                        {{ trans('installer_messages.environment.wizard.form.app_tabs.vapid_help_label') }} <br>
                        <a href="https://d3v.one/vapid-key-generator/" target="_blank">{{ trans('installer_messages.environment.wizard.form.app_tabs.vapid_get_label') }}</a>
                        <div class="form-group {{ $errors->has('vapid_public') ? ' has-error ' : '' }}">
                            <label for="vapid_public" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.vapid_public_label') }}</label>
                            <input type="text" name="vapid_public" id="vapid_public" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.vapid_public_placeholder') }}" />
                            @if ($errors->has('vapid_public'))
                                <span class="error-block">
                                    {{ $errors->first('vapid_public') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('vapid_private') ? ' has-error ' : '' }}">
                            <label for="vapid_private" class="col-md-4 control-label">{{ trans('installer_messages.environment.wizard.form.app_tabs.vapid_private_label') }}</label>
                            <input type="text" name="vapid_private" id="vapid_private" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.vapid_private_placeholder') }}" />
                            @if ($errors->has('vapid_private'))
                                <span class="error-block">
                                    {{ $errors->first('vapid_private') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <p>
                    <div class="btn-group col-md-6" role="group" aria-label="submit">
                        <button class="btn btn-success mr-4" type="submit">
                            {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
                            <img src="/assets/icons/chevron-right.svg" />
                        </button>
                    </div>
                </p>
                </form>
            </div>
            

    </div>

    <script type="text/javascript">
        function checkEnvironment(val) {
            var element=document.getElementById('environment_text_input');
            if(val=='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }
    </script>
    </div>
</div>
@endsection
