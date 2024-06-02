<?php

use App\Services\Patterns\Creational\AbstractFactory\CustomerFactoryInterface;
use App\Services\Patterns\Creational\AbstractFactory\DeliveryInterface;
use App\Services\Patterns\Creational\AbstractFactory\PaymentInterface;
use Invoker\Invoker;
use Invoker\InvokerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

return [
    InvokerInterface::class => static function (ContainerInterface $c) {
        return new Invoker(null, $c);
    },

    Request::class => DI\factory(fn() => Request::createFromGlobals()),
    DeliveryInterface::class => DI\autowire(),
    PaymentInterface::class => DI\autowire(),
    CustomerFactoryInterface::class => DI\autowire(),
];
