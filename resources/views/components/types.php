<?php

return [
    'tag' => [
        'type' => 'text',
        'description' => 'The HTML tag to use for the component. For example a or button or div.',
    ],
    'size' => [
        'type' => 'options',
        'options' => [
            'sm', 'md', 'lg', 'xl'
        ],
        'description' => 'The size of the component. For example sm, md, lg, xl.',
    ],
    'color' => [
        'type' => 'options',
        'options' => [
            'black', 'white', 'gray', 
            'c1', 'c2', 'c3', 'c4',
            'c1-pastel', 'c1-soft', 'c1-full',
            'c2-pastel', 'c2-soft', 'c2-full',
            'c3-pastel', 'c3-soft', 'c3-full',
            'c4-pastel', 'c4-soft', 'c4-full',
        ],
        'description' => 'The color of the component. For example black, white, gray, c1-pastel etc.',
    ],
    'icon' => [
        'type' => 'text',
        'modifiers' => [
            'left', 'right'
        ],
        'description' => 'The icon to use for the component. For example fa fa-user.',
    ],
    'tooltip' => [
        'type' => 'text',
        'modifiers' => [
            'left', 'right',
            'top', 'bottom'
        ],
        'description' => 'The tooltip to use for the component. For example tooltip.left="Some text"',
    ]
];