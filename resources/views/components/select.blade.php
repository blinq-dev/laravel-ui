@props([
    /**
     * @name Select
     * @description Select
     */

    /**
     * @param tag tag
     * @default 'button'
     */
    'tag' => 'select',
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

/***************
 * Colors
 ***************/
$colorClass = str($colors)->contains('border') ? 'mode-border ' . $colors : $colors;

/***************
 * Icon
 ***************/
$iconClass = $icon;
$iconComponents = explode(' ', $icon);
$iconColor = $iconComponents[2] ?? '';

@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "input $sizeClass $colorClass"]) }}>{{ $slot }}</{{ $tag }}>