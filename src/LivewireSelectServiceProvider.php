<?php

namespace Asantibanez\LivewireSelect;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LivewireSelectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-select');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-select'),
            ], 'livewire-select-views');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livewire-select');

        Blade::directive('livewireSelectScripts', function () {
            return <<<'HTML'
                <script>
                    window.livewire.on('livewire-select-focus-search', (data) => {
                        const el = document.getElementById(`${data.name || 'invalid'}`);

                        if (!el) {
                            return;
                        }

                        el.focus();
                    });
                </script>
HTML;
        });
    }
}
