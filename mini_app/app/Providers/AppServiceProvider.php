<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PluginSystem\PluginManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('plugins')) {
                $manager = new PluginManager();
                $manager->bootActivePlugins();
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Błąd ładowania pluginów: " . $e->getMessage());
        }
    }
}
