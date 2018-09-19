<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Routing\redirect;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    /*protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];*/

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        /* Event::listen('Illuminate\Auth\Events\Login', function() {
            if(auth()->user()->hasRole('admin', 'editor')){
                dd('Just logged in, it works!')
            }
        });*/
    }
}
