<?php

// use Senna\CMS\RouteFallback;

function get_codejump_data_filter_filename($filename) {
    // vscode://file//Users/x/Projects/Code/laravel/packages/senna/insights/src/Livewire/Senna/DashboardsAdmin.php
    // /Users/x/Projects/Code/laravel/schoolofmusic/app/Http/Livewire/Website/Home.php
    $replacements = [
        // '/Users/x/Projects/Code/laravel/schoolofmusic', '/code/schoolofmusic',
        '/Users/x/Projects/Code/laravel/packages/senna' => '/code/laravel/packages/senna',
    ];

    foreach($replacements as $from => $to) {
        $filename = str_replace($from, $to, $filename);
    }

    return $filename;
}

function get_codejump_data_memory_usage()
{
    $size = memory_get_usage(true);
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).''.$unit[$i];
}

function get_codejump_data_time() {
    // return microtime(true) - LARAVEL_START;
    return @round((microtime(true) - LARAVEL_START) * 1000, 0) . 'ms';
}

function get_codejump_data() {
    try {
        $route = request()->route();
        $controller = $route->getController();
    
        $reflector = new ReflectionClass($controller);
        
        // Add vscode link
        $controllerLink = "vscode://file/" . get_codejump_data_filter_filename($reflector->getFileName());
        $controllerName = $controller::class;
            
        $view = null;
    
        // if ($controller instanceof RouteFallback) {
        //     $view = collect(RouteFallback::$loadedComponents)->last();
    
        //     try {
        //         $data = $view->getData();
        
        //         if (isset($data['manager']->instance)) {
        //             $controller = $data['manager']->instance;
        //         }
                
        //         if ($controller) {
        //             $reflector = new ReflectionClass($controller);
        //             $controllerLink = "vscode://file/" . get_codejump_data_filter_filename($reflector->getFileName());
        //             $controllerName = $controller::class;
        //         }
        //     } catch(\Error $e) {
        //         // 
        //     }
        // }
      
        // Check if the render function has arguments
        try {
            $render = $reflector->getMethod('render');
            $renderParams = $render->getParameters();
    
            if (!count($renderParams)) {
                try {
                    $view = $controller->render();
                    $viewPath = $view->getPath();
                } catch(\Error $e) {
                    $viewPath = null;
                }
            }
        } catch(ReflectionException $ex) {
            $renderParams = [];
        }
    
        return (object) [
            'stats' => (object) [
                'memory' => get_codejump_data_memory_usage(),
                'time' => get_codejump_data_time(),
            ],
            'controller' => (object)  [
                'name' => str($controllerName)->replace("App\\Http\\", ""),
                'link' => $controllerLink,
            ],
            'view' => $view ? (object) [
                'name' => basename($viewPath),
                'link' => "vscode://file/" . get_codejump_data_filter_filename($viewPath),
            ] : null
        ];
    } catch(\Throwable $e) {
        return null;
    }
}