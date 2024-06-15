<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Bridge;

/**
 * Класс адаптер для использования апи доставки №1 по удобному нам интерфейсу
 */
readonly class DeliveryFirstGetawayAdapter implements DeliveryGetawayInterface
{
    public function __construct(private FirstDeliveryApi $delivery)
    {
    }

    /**
     * @param string $tariffCode
     * @param array{id: int, price: float, weight: float} $items
     * @param int $from
     * @param int $to
     * @return string
     */
    public function order(string $tariffCode, array $items, int $from, int $to): string
    {
        $tariffRate = $this->getTariffRateByCode($tariffCode);

        return $this->delivery->order($tariffRate, $items, $from, $to);
    }

    public function calculateShippingCost(string $tariffCode, int $from, int $to): float
    {
        $tariffRate = $this->getTariffRateByCode($tariffCode);

        return $this->delivery->tariffCalculator($tariffRate, $from, $to);
    }

    public function getTariffs(): array
    {
        return $this->delivery->getTariffsRate();
    }

    private function getTariffRateByCode(string $tariffCode): float
    {
        $tariffs = $this->getTariffs();

        return $tariffs[$tariffCode];
    }
}
