<?php

$weights = ['', '100...500'];
$colors = ['c0...c4'];
$combinations = [];

foreach($colors as $color) {
    foreach($weights as $weight) {
        if($weight) {
            $combinations[] = "$color-$weight";
        }
        else {
            $combinations[] = $color;
        }
    }
}

$combinations[] = 'black';
$combinations[] = 'white';

return [
    'tag' => [
        'type' => 'string',
        'description' => 'The HTML tag to use for the component. For example a or button or div.',
        'example' => '<x-#component# #prop#="div" />',
    ],
    'size' => [
        'type' => 'options',
        'example' => '<x-#component# #prop#="sm" />',
        'options' => [
            'sm', 'md', 'lg', 'xl'
        ],
        'description' => 'The size of the component. For example sm, md, lg, xl.',
    ],
    'class' => [
        'type' => 'string',
        'example' => '<x-#component# #prop#="c1-100" />',
        'options' => [
            ...array_map(fn($x) => "bg-$x", $combinations),
            ...array_map(fn($x) => "text-$x", $combinations),
            ...array_map(fn($x) => "border-$x", $combinations),
        ],
        'description' => 'Color/border classes. For example black, white, gray, c1-100 etc.',
    ],
    'icon' => [
        'type' => 'string',
        'modifiers' => [
            'left', 'right'
        ],
        'example' => '<x-#component# #prop#="person_add_alt@material/default text-black" />',
        'description' => 'The icon to use for the component. {pack} {name} {color}',
    ],
    'tooltip' => [
        'type' => 'string',
        'example' => '<x-#component# #prop#.left="Some text" />',
        'modifiers' => [
            'left', 'right',
            'top', 'bottom'
        ],
        'description' => 'The tooltip to use for the component.',
    ]
];