<?php
$configKey = "forwarder";

Route::get(Config::get("{$configKey}.route.verb"), [
    'as'         => 'forwarder',
    'middleware' => Config::get("{$configKey}.middleware"),
    'uses'       => Config::get("{$configKey}.route.action"),
]);
