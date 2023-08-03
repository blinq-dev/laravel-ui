<?php

namespace Blinq\UI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Blinq\UI\UI
 */
class UI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Blinq\UI\UI::class;
    }
}
