<?php

$weights = ['', '100', '200', '300', '400', '500'];
$colors = ['c0', 'c1', 'c2', 'c3', 'c4'];
$classes = [
    "text",
    "!text",
    "bg",
    "!bg",
    "border",
    "!border"
];

$output = [];

foreach($classes as $class) {
    foreach($colors as $color) {
        foreach($weights as $weight) {
            if($weight) {
                $output[] = "$class-$color-$weight";
            }
            else {
                $output[] = "$class-$color";
            }
        }
    }

    $output[] = "$class-white";
    $output[] = "$class-black";
}

// write to tailwind.safelist.txt
file_put_contents(__DIR__ . "/tailwind.safelist.txt", implode("\n", $output));