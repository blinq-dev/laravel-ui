<?php

function dynamic_blinq_component($componentName) {
    return config('blinq-ui.prefix', null) ? config('blinq-ui.prefix', null) . "-" . $componentName : $componentName;
}

function dynamic_blinq_icons_component($componentName) {
    return config('blinq-icons.prefix', null) ? config('blinq-icons.prefix', null) . "-" . $componentName : $componentName;
}

