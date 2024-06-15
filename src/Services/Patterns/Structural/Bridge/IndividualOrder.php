<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Bridge;

class IndividualOrder extends AbstractOrder
{
    /**
     * Бизнес логика предполагает, что мы должны уведомить физ.лиц о слишком большой цене заказа
     */
    public function getOrderPriceWithDelivery(float $itemsPrice, string $tariffCode, int $from, int $to): float
    {
        $this->notifyIfBigOrderCostWithDelivery($itemsPrice);

        return $itemsPrice + $this->delivery->calculateShippingCost($tariffCode, $from, $to);
    }

    private function choseDelivery(float $itemsPrice): void
    {
        if ($itemsPrice >= 600) {
            $this->changeDelivery(app()->container()->get(DeliveryFirstGetawayAdapter::class));
        } else {
            $this->changeDelivery(app()->container()->get(DeliverySecondGetawayAdapter::class));
        }
    }

    private function notifyIfBigOrderCostWithDelivery(float $orderCost): void
    {
        if ($orderCost > 600) {
            echo '<b>Слишком большая цена заказа!</b><br>';
        }
    }
}
