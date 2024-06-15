<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Bridge;

interface DeliveryGetawayInterface
{
    public function calculateShippingCost(string $tariffCode, int $from, int $to): float;

    public function order(string $tariffCode, array $items, int $from, int $to): string;

    public function getTariffs(): array;
}
