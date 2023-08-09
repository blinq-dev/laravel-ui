<?php

namespace Blinq\UI;

use Spatie\LaravelPackageTools\Package;
use Blinq\UI\Commands\UICommand;

class UIServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ui')
            ->hasConfigFile('blinq.ui')
            ->hasViews('blinq.ui')
            // ->hasMigration('create_ui_table')
            ->hasCommand(UICommand::class);

        $this->registerViews(); 
        $this->registerRoutes();
    }
    
    public function packageRegistered()
    {
        $this->registerHelperDirectory("Helpers", inGlobalScope: true);
        $this->registerViewComponentDirectory("../resources/views/components", config('blinq.ui.prefix', null), "blinq");
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
