<?php

use App\Services\Patterns\Creational\Builder\ProductBuilder;
use App\Services\Patterns\Creational\Builder\ProductBuilderInterface;
use Invoker\Invoker;
use Invoker\InvokerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

return [
    InvokerInterface::class => static function (ContainerInterface $c) {
        return new Invoker(null, $c);
    },

    Request::class => DI\factory(fn() => Request::createFromGlobals()),
    ProductBuilderInterface::class => DI\get(ProductBuilder::class),
];
