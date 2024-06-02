<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\App;
use App\RouteDispatcher;

$app = new App();
$dispatcher = $app->container()->get(RouteDispatcher::class);
$dispatcher->fastRoute();
