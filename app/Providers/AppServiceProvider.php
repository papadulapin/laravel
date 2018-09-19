<?php

namespace App\Providers;

use App\Observers\PermissionObserver;
use App\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //model events
        Permission::observe(PermissionObserver::class);


        view()->composer('users.form', function($view) {
            $allRoles = \App\Role::all();
            $view->with(compact('allRoles'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
