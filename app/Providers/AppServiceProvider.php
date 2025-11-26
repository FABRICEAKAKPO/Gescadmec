<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Service Provider principal: enregistre et initialise des services.
 * - register(): pour lier des services dans le conteneur
 * - boot(): pour exécuter du code après démarrage (ex: config, vues)
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Enregistrer des services applicatifs (bindings, singletons...).
     */
    public function register(): void
    {
        //
    }

    /**
     * Amorcer des services (configuration, observers, macros...).
     */
    public function boot(): void
    {
        //
    }
}
