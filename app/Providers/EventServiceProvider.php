<?php

namespace App\Providers;

use App\Events\AlerteEvent;
use App\Events\EndSeanceEvent;
use App\Events\SeanceStart;
use App\Listeners\AlerteListener;
use App\Listeners\EndSeanceEventListener;
use App\Listeners\SeanceStartListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AlerteEvent::class => [
            AlerteListener::class,
        ],
        EndSeanceEvent::class => [
            EndSeanceEventListener::class,
        ],
        SeanceStart::class => [
            SeanceStartListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
