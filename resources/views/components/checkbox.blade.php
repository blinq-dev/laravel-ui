@props([
    /**
     * @name Checkbox
     * @description Checkbox
     */

    /**
     * @param tag tag
     * @default 'button'
     */
    'tag' => 'input',
    /**
     * @param size size
     * @default 'md'
     */
    'size' => 'md',
    /**
     * @param color colors
     * @default null
     */
    'colors' => null,
    /**
     * @param icon icon
     * @default null
     */
    'icon' => null,
    /**
     * @param string placeholder The placeholder
     * @default null
     */
])

@php
/***************
 * Size
 ***************/
$sizeClass = [
    'sm' => 'size-sm',
    'md' => 'size-md',
    'lg' => 'size-lg',
    'xl' => 'size-xl',
][$size];

$colorClass = str($colors)->contains('border') ? 'mode-border ' . $colors : $colors;

/***************
 * Icon
 ***************/
$iconClass = $icon;
$iconComponents = explode(' ', $icon);
$iconColor = $iconComponents[2] ?? '';

@endphp

<{{ $tag }} {{ $attributes->merge(['type' => 'checkbox', 'class' => "input $sizeClass $colorClass"]) }}>{{ $slot }}</{{ $tag }}>