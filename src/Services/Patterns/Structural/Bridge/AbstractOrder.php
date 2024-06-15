<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Bridge;

abstract class AbstractOrder
{
    public function __construct(
        public DeliveryGetawayInterface $delivery
    ) {
    }

    public function changeDelivery(DeliveryGetawayInterface $delivery): void
    {
        $this->delivery = $delivery;
    }

    abstract public function getOrderPriceWithDelivery(
        float  $itemsPrice,
        string $tariffCode,
        int    $from,
        int    $to
    ): float;
}
