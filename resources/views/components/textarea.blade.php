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
][$size] ?? 'size-md';

/***************
 * Class
 ***************/
$class = str($class)->contains('border') ? 'mode-border ' . $class : $class;

if (!str($class)->contains('border') && !str($class)->contains('bg')) {
    $class = 'mode-border ' . $class;
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

/***************
 * Copyable
 ***************/
$copyableCode = <<<'HTML'
@click="$el.select(); $nextTick(() => document.execCommand('copy'))"
HTML;

$copyable = $copyable ? $copyableCode : '';

@endphp

<div {{ $attributes->namespace('wrapper')->merge(['class' => "textarea-wrapper relative flex items-start $sizeClass $class"]) }}>
    @if($iconId && !$isRight)
    <x-icon class='ml-4 icon grow-0 shrink-0 icon-left {{ $iconColor }}' :id='$iconId' />
    @endif
    @if(isset($left))
        {{ $left }}
    @endif
    <{{ $tag }} {!! $copyable !!} {{ $attributes->root()->except('class')->merge(['class' => "textarea"]) }} {{ $attributes->namespace('input') }}>{{ $slot }}</{{ $tag }}>
    @if(isset($right))
        {{ $right }}
    @endif
    @if($iconId && $isRight)
    <x-icon class='!-ml-4 !mr-4 icon grow-0 shrink-0 icon-right {{ $iconColor }}' :id='$iconId' />
    @endif
</div>