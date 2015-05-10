<?php
$configKey = "forwarder";
$verb      = Config::get("{$configKey}.route.verb");

Route::group(['prefix' => $verb], function () use ($configKey) {
    Route::get('{any?}', [
        'as'         => 'forwarder',
        'middleware' => Config::get("{$configKey}.middleware"),
        'uses'       => Config::get("{$configKey}.route.action"),
    ])->where('any', '.*');
});
