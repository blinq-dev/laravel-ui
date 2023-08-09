<?php

function get_ui_documentation_props($str, $prop) {
    preg_match_all("/@$prop (.*)/", $str, $matches);

    return $matches[1];
}

function get_ui_documentation_prop($str, $prop) {
    return get_ui_documentation_props($str, $prop)[0] ?? null;
}

function get_ui_documentation_example_defaults($type) {
    if ($type === "input") {
        return [
            'placeholder' => 'Some placeholder text',
        ];
    }
    if ($type === "textarea") {
        return [
            '$slot' => 'Some textarea contents',
        ];
    }
    if ($type === "button") {
        return [
            '$slot' => 'Click!',
        ];
    }

    return [];
}

function get_ui_documentation(string $component_name) {
    $view = file_get_contents(__DIR__ . "/../../resources/views/components/$component_name.blade.php");

    $name = get_ui_documentation_prop($view, 'name');
    $description = get_ui_documentation_prop($view, 'description');

    // Get all the param properties
    $props = get_ui_documentation_props($view, 'param');

    $props = collect($props)->map(function($x) {
        $x = explode(' ', $x);
        return [
            'type' => $x[0] ?? null,
            'name' => $x[1] ?? null,
            // All words remaining
            'description' => implode(' ', array_slice($x, 2))
        ];
    });

    $types = include __DIR__ . "/../../resources/views/components/types.php";

    return view('blinq-ui::documentation', [
        'component' => $component_name,
        'name' => $name,
        'description' => $description,
        'props' => $props,
        'types' => $types,
        'defaults' => get_ui_documentation_example_defaults($component_name),
    ]);
}