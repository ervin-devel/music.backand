<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Track;
use App\Models\Artist;
use App\Models\User;
use App\Observers\AlbumObserver;
use App\Observers\GenreObserver;
use App\Observers\TrackObserver;
use App\Observers\ArtistObserver;
use App\Observers\UserObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));
        Album::observe(AlbumObserver::class);
        Track::observe(TrackObserver::class);
        Artist::observe(ArtistObserver::class);
        Genre::observe(GenreObserver::class);
        User::observe(UserObserver::class);
    }
}
