<?php

namespace App\Providers;

use App\Models\Video;
use App\Events\VideoCreated;
use App\Listeners\SendEmail;
use App\Listeners\ProcessVideo;
use App\Observers\VideoObserver;
use App\Listeners\CreatedThumbnail;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        VideoCreated::class => [
            SendEmail::class,
            ProcessVideo::class,
            CreatedThumbnail::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Video::observe(VideoObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
