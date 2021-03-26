<?php

namespace Starmoozie\DynamicPermission;

use Illuminate\Support\ServiceProvider;

class DynamicPermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadReources();
    }

    public function register()
    {
        $this->app->make('Starmoozie\DynamicPermission\app\Http\Controllers\MenuCrudController');
    }

    private function loadReources()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/base.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'dynamic_view');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang/', 'dynamic_trans');
    }
}
