<?php

namespace App\Providers;

use App\Repositories\AuthRepository\AuthRepository;
use App\Repositories\AuthRepository\IAuthRepository;
use App\Repositories\GeminiRepository\GeminiRepository;
use App\Repositories\GeminiRepository\IGeminiRepository;
use App\Repositories\RandomGreetingsRepository\IRandomGreetingsRepository;
use App\Repositories\RandomGreetingsRepository\RandomGreetingsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IRandomGreetingsRepository::class, RandomGreetingsRepository::class);
        $this->app->bind(IGeminiRepository::class, GeminiRepository::class);
        $this->app->bind(IAuthRepository::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
