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
     * @param color bg
     * @default null
     */
    'bg' => null,
    /**
     * @param color icon
     * @default null
     */
    'icon' => null,
    /**
     * @param color ring
     * @default 'black'
     */
    'ring' => 'black',
    /**
     * @param color text
     * @default null
     */
    'text' => null,
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
$sizeClass = [
    'sm' => 'size-sm',
    'md' => 'size-md',
    'lg' => 'size-lg',
    'xl' => 'size-xl',
][$size];

/***************
 * Bg
 ***************/
$bgClass = $bg ? "!bg-$bg" : "";

/***************
 * Ring
 ***************/
$ringClass = $ring ? "mode-ring !ring-$ring" : "";

/***************
 * Text
 ***************/
$textClass = $text ? "!text-$text" : "";
/***************
 * Icon
 ***************/
$iconClass = $icon ? "text-$icon" : "";

$copyable = $copyable ? '@click="$el.select(); $nextTick(() => document.execCommand(\'copy\'))"' : '';

@endphp

<{{ $tag }} {!! $copyable !!} {{ $attributes->merge(['class' => "input $sizeClass $ringClass $textClass $bgClass"]) }}>{{ $slot }}</{{ $tag }}>