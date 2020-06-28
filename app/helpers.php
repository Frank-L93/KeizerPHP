<?php
use App\Config;
function settings($key = null)
{
    $settings = app('App\Settings');
    config(['app.name' => Config::CompetitionName()]);
    return $key ? $settings->get($key) : $settings;
}
