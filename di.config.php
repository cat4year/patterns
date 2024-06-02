<?php

use App\Controllers\ControllerInterface;
use Invoker\Invoker;
use Invoker\InvokerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

return [
    InvokerInterface::class => static function (ContainerInterface $c) {
        return new Invoker(null, $c);
    },

    Request::class => DI\factory(fn() => Request::createFromGlobals()),
    ControllerInterface::class => DI\autowire(),
];
