<?php

namespace Blinq\UI;

class UI
{
    public Notify $notify;
    // constructor
    public function __construct()
    {
        $this->notify = new Notify();
    }
}
