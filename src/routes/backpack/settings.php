<?php

/*
|--------------------------------------------------------------------------
| Backpack\Settings Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\Settings package.
|
*/

Route::group([
    'namespace'  => 'Backpack\Settings\app\Http\Controllers',
    'prefix'     => config('hncore.base.route_prefix', 'admin'),
    'middleware' => ['web', hncore_middleware()],
], function () {
    Route::crud(config('hncore.settings.route'), 'SettingCrudController');
});
