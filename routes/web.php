<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

Route::post('/blinq-ui/docs/example/{component}', function ($component) {
    $props = request()->input('props');
    $slot = '';

    // Check if $slot is set
    if (isset($props['$slot'])) {
        $slot = $props['$slot'];
        $slot = preg_replace("/[^a-zA-Z0-9\.\-!? ]+/", "", $slot);
        unset($props['$slot']);
    }

    $component = preg_replace("/[^a-zA-Z0-9\.]+/", "", $component);

    // Turn props into attribute string
    $attributes = str(collect($props)->map(function($value, $key) {
        $key = preg_replace("/[^a-zA-Z0-9\-]+/", "", $key);
        $value = preg_replace("/[^a-zA-Z0-9\.\-!? \/_:]+/", "", $value);

        if ($value === "") {
            return "";
        }
        
        if ($value === "_empty_") {
            $value = "";
        }

        return "$key=\"$value\"";
    })->filter()->implode(' '))
        ->prepend(' ');

    if ($attributes->trim()->isEmpty()) {
        $attributes = '';
    }
    
    $code = "<x-$component$attributes>$slot</x-$component>";
    $renderedComponent = Blade::render("$code");

    return response()->json([
        'code' => $code,
        'result' => $renderedComponent,
    ]);
});
