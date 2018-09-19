<?php

namespace App\Providers;

use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Permission::get()->map(function ($permission) {
            Gate::define($permission->slug, function ($user) use ($permission) {
                return $user->hasPermissionTo($permission);
            });
        });

        Role::get()->map(function ($role) {
            Gate::define($role->slug, function ($user) use ($role) {
                return $user->hasRole($role);
            });
        });        

        //roles
        Blade::directive('role', function ($role) {
            return "<?php if( auth()->check() && auth()->user()->hasRole({$role}) ): ?>";
        });

        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });

        //permissions
        Blade::directive('permission', function ($permission) {
            return "<?php if( auth()->check() && auth()->user()->hasPermission({$permission}) ): ?>";
        });

        Blade::directive('endpermission', function ($permission) {
            return "<?php endif; ?>";
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
