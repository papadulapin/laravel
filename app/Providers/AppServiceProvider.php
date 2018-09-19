<?php

namespace App\Providers;

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

        // view()->composer('roles.form', function($view) {
        //     $allPermissions = \App\Permission::all();
        //     $view->with(compact('allPermissions'));
        // });

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
