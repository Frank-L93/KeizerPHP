<?php

use App\Config;

function settings($key = null)
{
    $settings = app('App\Settings');
    
    return $key ? $settings->get($key) : $settings;
}
