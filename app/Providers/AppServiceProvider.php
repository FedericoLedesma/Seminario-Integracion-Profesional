<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\RacionesDisponibles;
use App\Observers\RacionesDisponiblesObserver;
use App\MenuPersona;
use App\Observers\MenuPersonaObserver;
use App\DietaActivaRacion;
use App\Observers\DietaActivaRacionObserver;
use App\DietaActiva;
use App\Observers\DietaActivaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        RacionesDisponibles::observe(RacionesDisponiblesObserver::class);
        MenuPersona::observe(MenuPersonaObserver::class);
        DietaActivaRacion::observe(DietaActivaRacionObserver::class);
        DietaActiva::observe(DietaActivaObserver::class);
    }
}
