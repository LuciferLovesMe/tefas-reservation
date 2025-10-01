<?php

namespace App\Providers;

use App\Interfaces\RuanganInterface;
use App\Interfaces\TefaInterface;
use App\Repositories\RuanganRepository;
use App\Repositories\TefaRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TefaInterface::class, TefaRepository::class);
        $this->app->bind(RuanganInterface::class, RuanganRepository::class);
        $this->app->bind(\App\Interfaces\ReservasiInterface::class, \App\Repositories\ReservasiRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
