@props([
    /**
     * @name Textarea
     * @description Textarea with different colors and sizes
     */

    /**
     * @param tag tag
     * @default 'button'
     */
    'tag' => 'textarea',
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
     /**
     * @param bool copyable Copy on select
     * @default false
     */
    'copyable' => false,
])

@php
/***************
 * Size
 ***************/
/***************
 * Size
 ***************/
$sizeClass = [
    'sm' => 'size-sm',
    'md' => 'size-md',
    'lg' => 'size-lg',
    'xl' => 'size-xl',
][$size];

$isRing = false;

$colorClass = str($colors)->contains('border') ? 'mode-border ' . $colors : $colors;

/***************
 * Icon
 ***************/
$iconClass = $icon;
$iconComponents = explode(' ', $icon);
$iconColor = $iconComponents[2] ?? '';

$copyable = $copyable ? '@click="$el.select(); $nextTick(() => document.execCommand(\'copy\'))"' : '';

@endphp

<{{ $tag }} {!! $copyable !!} {{ $attributes->merge(['class' => "input $sizeClass $colorClass"]) }}>{{ $slot }}</{{ $tag }}>