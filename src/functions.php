<?php

function app(): App\App
{
    static $app = null;

    if ($app === null) {
        $app = new App\App();
    }

    return $app;
}