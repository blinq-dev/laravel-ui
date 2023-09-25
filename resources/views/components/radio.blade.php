@props([
    /**
     * @name Radio
     * @description Radio
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
     * @param class class
     * @default null
     */
    'class' => null,
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
][$size] ?? 'size-md';


/***************
 * Class
 ***************/
$class = str($class)->contains('border') ? 'mode-border ' . $class : $class;

if (!str($class)->contains('border') && !str($class)->contains('bg')) {
    $class = 'mode-border ' . $class;
}
@endphp

<div {{ $attributes->namespace('wrapper')->merge(['class' => "radio-wrapper relative flex items-center $sizeClass $class"]) }}>
    @if(isset($left))
        {{ $left }}
    @endif
    <{{ $tag }} {{ $attributes->root()->except('class')->merge(['class' => "radio", 'type' => 'radio']) }} {{ $attributes->namespace('input') }}>{{ $slot }}</{{ $tag }}>
    @if(isset($right))
        {{ $right }}
    @endif
</div>