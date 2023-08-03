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
            ->hasConfigFile()
            ->hasViews()
            // ->hasMigration('create_ui_table')
            ->hasCommand(UICommand::class);
    }
    
    public function packageRegistered()
    {
        $this->registerHelperDirectory("Helpers", inGlobalScope: true);
        $this->registerViewComponentDirectory("../resources/views/components", "ui", null);
    }

    

}
