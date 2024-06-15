<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Bridge;

/**
 * Класс апи доставки 2, который нужно адаптировать
 * Формулы некорректны, т.к. в реализации паттерна нам это не нужно
 */
class SecondDeliveryApi
{
    public function shippingPrice(string $tariffCode, int $from, int $to): float
    {
        return $this->getTariffRateByCode($tariffCode) * $from * $to;
    }

    public function createOrder(string $tariffCode, int $from, int $to, array $itemPrices): float
    {
        $itemsSum = array_sum($itemPrices);
        $orderId = $itemsSum * $from * $to * $this->getTariffRateByCode($tariffCode);

        return $orderId;
    }

    private function getTariffRateByCode(string $tariffName): float
    {
        return $this->getTariffs()[$tariffName];
    }

    /**
     * @return float[]
     */
    public function getTariffs(): array
    {
        return [
            'tariff1' => 1.2,
            'tariff2' => 2.4,
            'tariff3' => 3.6,
        ];
    }
}
