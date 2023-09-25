<?php

use Illuminate\View\ComponentAttributeBag;

if (!method_exists(ComponentAttributeBag::class, 'macro')) return;
if (ComponentAttributeBag::hasMacro('keys')) return;

/**
 * Strip a part of a string from the attribute keys
 */
ComponentAttributeBag::macro('keys', function () {
    $that = clone $this;
    $keys = collect();

    foreach($that as $key => $value) {
        $keys->push($key);
    }

    return $keys;
});