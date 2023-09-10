<?php

$colors = ['black', 'white', 'gray', 'gray-50', 'c1', 'c2', 'c3', 'c4', 'c1-pastel', 'c1-soft', 'c1-full', 'c2-pastel', 'c2-soft', 'c2-full', 'c3-pastel', 'c3-soft', 'c3-full', 'c4-pastel', 'c4-soft', 'c4-full'];

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
    'color' => [
        'type' => 'string',
        'example' => '<x-#component# #prop#="c1-pastel" />',
        'options' => [
            ...collect($colors)->map(fn($x) => "bg-$x")->toArray(),
            ...collect($colors)->map(fn($x) => "text-$x")->toArray(),
            ...collect($colors)->map(fn($x) => "border-$x")->toArray(),
        ],
        'description' => 'The color. For example black, white, gray, c1-pastel etc.',
    ],
    'icon' => [
        'type' => 'string',
        'modifiers' => [
            'left', 'right'
        ],
        'example' => '<x-#component# #prop#="material/default person_add_alt text-black" />',
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