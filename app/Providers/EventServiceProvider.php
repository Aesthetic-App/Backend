<?php

namespace App\Providers;

use App\Models\Theme;
use App\Models\ThemeCategory;
use App\Observers\MediaObserver;
use App\Observers\ThemeCategoryObserver;
use App\Observers\ThemeObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Theme::observe(ThemeObserver::class);
        Media::observe(MediaObserver::class);
    }
}
