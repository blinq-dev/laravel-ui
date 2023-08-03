<?php

$types = include_once __DIR__ . "/resources/views/components/types.php";

$classes = [
    "size",
    "!size",
    "text",
    "!text",
    "bg",
    "!bg",
    "ring",
    "!ring"
];

$output = [];

foreach($types['color']['options'] ?? [] as $color) {
    foreach($classes as $class) {
        $output[] = "{$class}-{$color}";
    }
}

// write to tailwind.safelist.txt
file_put_contents(__DIR__ . "/tailwind.safelist.txt", implode("\n", $output));