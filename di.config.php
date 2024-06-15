<?php

use App\Services\Patterns\Creational\Builder\ProductBuilder;
use App\Services\Patterns\Creational\Builder\ProductBuilderInterface;
use App\Services\Patterns\Structural\Bridge\DeliveryFirstGetawayAdapter;
use App\Services\Patterns\Structural\Bridge\DeliveryGetawayInterface;
use App\Services\Patterns\Structural\Bridge\DeliverySecondGetawayAdapter;
use App\Services\Patterns\Structural\Bridge\IndividualOrder;
use App\Services\Patterns\Structural\Bridge\LegalOrder;
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
    DeliveryGetawayInterface::class => DI\get(DeliveryFirstGetawayAdapter::class),
    LegalOrder::class => DI\autowire()->constructorParameter('delivery', DI\get(DeliveryFirstGetawayAdapter::class)),
    IndividualOrder::class => DI\autowire()->constructorParameter('delivery', DI\get(DeliverySecondGetawayAdapter::class)),
];
