<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\RouteDispatcher;

$dispatcher = app()->container()->get(RouteDispatcher::class);
$dispatcher->fastRoute();
