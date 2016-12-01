<?php

namespace Backpack\Settings;

use Backpack\Settings\app\Models\Setting as Setting;
use Config;
use Illuminate\Config\Repository;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Route;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // publish the migrations and seeds
        $this->publishes([__DIR__.'/database/migrations/' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__.'/database/seeds/' => database_path('seeds')], 'seeds');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(
            ['namespace' => 'Backpack\Settings\app\Http\Controllers'],
            function ($router) {
                // Admin Interface Routes
                Route::group(
                    [
                        'prefix' => config('backpack.base.route_prefix', 'admin'),
                        'middleware' => ['web', 'admin'],
                    ],
                    function () {
                        Route::resource('setting', 'SettingCrudController');
                    }
                );
            }
        );
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupRoutes($this->app->router);
        $this->app->singleton('settings', function () {
            $store = [];
            if (count(Schema::getColumnListing('settings'))) {
                // get all settings from the database
                $settings = Setting::all();
                foreach ($settings as $setting) {
                    $store[$setting->key] = $setting->value;
                }
            }

            return new Repository($store);
        });
    }
}
