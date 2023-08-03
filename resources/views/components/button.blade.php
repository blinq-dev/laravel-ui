@props([
    /**
     * @name Button
     * @description Buttons with different colors and sizes
     */

    /**
     * @param tag tag
     * @default 'button'
     */
    'tag' => 'button',
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
     * @default null
     */
    'ring' => null,
    /**
     * @param color text
     * @default null
     */
    'text' => null,
    /**
     * @param icon|color icon
     * @default null
     */
    'icon' => null,
    /**
     * @param tooltip icon
     * @default null
     */
    'tooltip' => null,
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

<{{ $tag }} {{ $attributes->merge(['class' => "button $sizeClass $ringClass $textClass $bgClass"]) }}>
    {{ $slot }}
</{{ $tag }}>