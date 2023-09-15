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
     * @param tooltip tooltip
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

$colorClass = str($colors)->contains('ring') ? 'mode-ring ' . $colors : $colors;

/***************
 * Icon
 ***************/
$iconClass = $icon;
$iconId = str($icon)->before(' ');
$iconColor = str($icon)->after(' ');

@endphp

{{-- Tag --}}
<{{ $tag }} {{ $attributes->merge(['class' => "button $sizeClass $colorClass"]) }}>
    {{-- Left --}}
    @if($icon)
        <x-icon class='icon icon-left {{ $iconColor }}' :id='$iconId' />
    @endif
    @if(isset($left))
        {{ $left }}
    @endif
    {{-- Slot --}}
    <span>{{ $slot }}</span>
    {{-- Right --}}
    @if(isset($right))
        {{ $right }}
    @endif
</{{ $tag }}>