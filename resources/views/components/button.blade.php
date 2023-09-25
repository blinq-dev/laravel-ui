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
     * @param class class
     * @default null
     */
    'class' => null,
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
][$size] ?? 'size-md';

$class = str($class)->contains('border') ? 'mode-border ' . $class : $class;

if (!str($class)->contains('border') && !str($class)->contains('bg')) {
    $class .= ' bg-c0-200';
}

/***************
 * Icon
 ***************/
$iconKey = $attributes->whereStartsWith('icon')->keys()->first();
$iconValue = $attributes->get($iconKey);
$isRight = str($iconKey)->contains('right');

$iconClass = $iconValue;

$iconId = str($iconValue)->contains(' ') ? str($iconValue)->before(' ') : $iconValue;
$iconColor = str($iconValue)->contains(' ') ? str($iconValue)->after(' ') : null;

@endphp

{{-- Tag --}}
<{{ $tag }} {{ $attributes->merge(['class' => "button $sizeClass $class", 'type' => 'button']) }}>
    {{-- Left --}}
    @if($iconId && !$isRight)
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
    @if($iconId && $isRight)
        <x-icon class='icon icon-right {{ $iconColor }}' :id='$iconId' />
    @endif
</{{ $tag }}>