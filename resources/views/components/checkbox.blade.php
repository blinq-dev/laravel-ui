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
     * @param color bg
     * @default null
     */
    'bg' => null,
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

@endphp

<{{ $tag }} {{ $attributes->merge(['type' => 'checkbox', 'class' => "input $sizeClass $ringClass $textClass $bgClass"]) }}>{{ $slot }}</{{ $tag }}>