<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Bridge;

/**
 * Класс апи доставки 1, который нужно адаптировать
 * Формулы некорректны, т.к. в реализации паттерна нам это не нужно
 */
class FirstDeliveryApi
{
    public function tariffCalculator(float $tariffRate, int $from, int $to): float
    {
        return $tariffRate * $from * $to;
    }

    /**
     * @param float $tariffRate
     * @param array{id: int, price: float, weight: float} $items
     * @param int $from
     * @param int $to
     * @return string
     */
    public function order(float $tariffRate, array $items, int $from, int $to): string
    {
        $itemIds = array_column($items, 'id');
        $itemsIdString = implode('-', $itemIds);
        $orderId = sprintf('%f_%d_%d_%s', $tariffRate, $from, $to, $itemsIdString);

        return $orderId;
    }

    /**
     * @return float[]
     */
    public function getTariffsRate(): array
    {
        return [
            'tariff1' => 1.1,
            'tariff2' => 2.2,
            'tariff3' => 3.3,
        ];
    }
}
