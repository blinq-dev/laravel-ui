<?php

namespace Blinq\UI;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\PackageServiceProvider as LaravelPackageToolsPackageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Illuminate\Support\Facades\File;
use Spatie\LaravelPackageTools\Exceptions\InvalidPackage;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

abstract class PackageServiceProvider extends LaravelPackageToolsPackageServiceProvider
{
    public function registerHelperDirectory(string $directory = null, bool $inGlobalScope = true)
    {
        $directory = $this->package->basePath($directory ?? 'Helpers');

        if (!File::exists($directory)) throw (new InvalidPackage("The helper directory `{$directory}` does not exist"));

        foreach (scandir($directory) as $helperFile) {
            $path = $directory . "/" . $helperFile;

            if (! is_file($path)) {
                continue;
            }

            $function = Str::before($helperFile, '.php');

            if ($inGlobalScope && function_exists($function)) {
                continue;
            }

            require_once $path;
        }
    }

    public function registerMacroDirectory(string $directory)
    {
        $directory = $this->package->basePath($directory ?? 'Helpers');

        if (!File::exists($directory)) throw (new InvalidPackage("The macro directory `{$directory}` does not exist"));
        
        foreach (scandir($directory) as $extensionFile) {
            $path = $directory . "/" . $extensionFile;

            if (substr($extensionFile, 0, 1) === ".") continue;

            if (! is_file($path)) {
                continue;
            }

            require_once $path;
        }
    }

    public function registerViewComponentDirectory(string $directory, string|null $alias = null, string $prefix = null)
    {
        $directory = $this->package->basePath($directory);
        
        $this->callAfterResolving(BladeCompiler::class, function () use($directory, $alias, $prefix) {
            foreach (File::allFiles($directory) as $file) {
                $component = $file->getRelativePathname();
                
                
                $this->registerViewComponent($component, $directory, $alias, $prefix);
            }
        });
    }

        /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerViewComponent(string $component, string $directory, string|null $alias = null, string $prefix = null)
    {
        $fullName = Str::replace('laravel-', '', $prefix ? ($prefix . "." . $this->package->name) : $this->package->name);
        $view = str_replace(".blade.php", "", $component);
        $view = str_replace("/", ".", $view);
        $alias = $alias ?? $fullName;

        $parentDirectory = str($directory)->afterLast('/');

        // dd($fullName . '::' . $parentDirectory . '.' . $view, $alias . '.' . $view);
        Blade::component($fullName . '::' . $parentDirectory . '.' . $view, $alias . '.' . $view);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $directory . "/" . $component => resource_path('views/vendor/' . $fullName . '/' . $parentDirectory . '/' . $component),
            ], $parentDirectory . '.' . $view);
        }
    }
}
