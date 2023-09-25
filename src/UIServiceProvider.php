<?php

namespace Blinq\UI;

use Spatie\LaravelPackageTools\Package;
use Blinq\UI\Commands\UICommand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Blade;

class UIServiceProvider extends PackageServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerRoutes();
        // $this->registerCommands();
        // $this->registerBladeComponents();

        $this->registerHelperDirectory("Helpers", inGlobalScope: true);
        $this->registerMacroDirectory("Macros/ComponentAttributeBag");
        $this->registerViewComponentDirectory("../resources/views/components", config('blinq-ui.prefix', null), "blinq");
    }
    
    public function boot()
    {
        $this->app->scoped(UI::class, function (Application $app) {
            return new UI();
        });
    }

    protected function registerConfig()
    {
        $config = __DIR__.'/../config/blinq-ui.php';

        $this->mergeConfigFrom($config, 'blinq-ui');
        $this->publishes([$config => config_path('blinq-ui.php')], ['blinq-ui', 'blinq-ui:config']);
    }

    public function registerCommands()
    {
        // $this->commands([
        //     Commands\DownloadCommand::class,
        // ]);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ui')
            ->hasConfigFile('blinq-ui')
            ->hasViews('blinq-ui')
            // ->hasMigration('create_ui_table')
            ->hasCommand(UICommand::class);

        $this->registerViews(); 
        $this->registerRoutes();
    }
   

    protected function registerViews() {
        $views = __DIR__.'/../resources/views';

        $this->publishes([ $views => base_path("resources/views/vendor/blinq-ui")], ['blinq-ui', 'blinq-ui:views']);

        $this->loadViewsFrom($views, 'blinq-ui');
    }

    public function registerRoutes()
    {
        // Only when APP_ENV is local
        if ($this->app->environment('local')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }
        // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

}
