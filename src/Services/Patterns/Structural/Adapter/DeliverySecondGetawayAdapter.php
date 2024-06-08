<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Adapter;

/**
 * Класс адаптер для использования апи доставки №2 по удобному нам интерфейсу
 */
readonly class DeliverySecondGetawayAdapter implements DeliveryGetawayInterface
{
    public function __construct(private SecondDeliveryApi $delivery)
    {
    }

    /**
     * @param string $tariffCode
     * @param array{price: float} $items
     * @param int $from
     * @param int $to
     * @return string
     */
    public function order(string $tariffCode, array $items, int $from, int $to): string
    {
        $itemPrices = array_column($items, 'price');

        return (string) $this->delivery->createOrder($tariffCode, $from, $to, $itemPrices);
    }

    public function calculateShippingCost(string $tariffCode, int $from, int $to): float
    {
        return $this->delivery->shippingPrice($tariffCode, $from, $to);
    }

    public function getTariffs(): array
    {
        return $this->delivery->getTariffs();
    }
}