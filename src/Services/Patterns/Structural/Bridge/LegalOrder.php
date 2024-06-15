<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Bridge;

class LegalOrder extends AbstractOrder
{
    public function getOrderPriceWithDelivery(float $itemsPrice, string $tariffCode, int $from, int $to): float
    {
        return $itemsPrice + $this->delivery->calculateShippingCost($tariffCode, $from, $to);
    }
}
