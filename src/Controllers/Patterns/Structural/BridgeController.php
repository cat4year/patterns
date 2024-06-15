<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Structural;

use App\Controllers\AbstractController;
use App\Services\Patterns\Structural\Bridge\AbstractOrder;
use App\Services\Patterns\Structural\Bridge\IndividualOrder;
use App\Services\Patterns\Structural\Bridge\LegalOrder;

readonly class BridgeController extends AbstractController
{
    /**
     * Реализация паттерна Мост
     * Ситуация: изначально мы понимали, что будем работать с несколькими сервисами доставки
     * Интерфейсы упрощенны, и не являются достаточными для реальной работы
     *
     * @todo: Переделать на более простом и очевидном примере
     */
    public function show(): void
    {
        $this->printer->heading('Реализация паттерна Мост', 1);

        $this->execute($this->container->get(LegalOrder::class));
        $this->printer->blankLines(2);
        $this->execute($this->container->get(IndividualOrder::class));
    }

    /**
     * @param AbstractOrder $order
     * @return void
     */
    private function execute(AbstractOrder $order): void
    {
        $items = $this->getFakeItems();
        $from = 111;
        $to = 222;
        $itemsPrice = $this->getItemsPrice($items);

        $this->printer->heading($order::class, 2);

        $tariffs = $order->delivery->getTariffs();
        $this->printer->array('Тарифы', $tariffs);
        $this->printer->blankLines();

        $this->printer->descriptionValue('Сумма всех товаров', $itemsPrice);
        $this->printer->blankLines(2);

        foreach ($tariffs as $tariffCode => $tariffRate) {
            $shippingCost = $order->delivery->calculateShippingCost($tariffCode, $from, $to);
            $this->printer->descriptionValue('Стоимость доставки', $shippingCost);
            $this->printer->blankLines();

            $orderCostWithDelivery = $order->getOrderPriceWithDelivery($itemsPrice, $tariffCode, $from, $to);
            $this->printer->descriptionValue(
                'Общая цена заказа (сумма товаров + сумма доставки)',
                $orderCostWithDelivery
            );
            $this->printer->blankLines();

            if ($shippingCost > 0) {
                $orderId = $order->delivery->order($tariffCode, $items, $from, $to);
                $this->printer->descriptionValue('Заказ принят. Номер заказа', $orderId);
                $this->printer->blankLines();
            }

            $this->printer->blankLines();
        }
    }

    private function getFakeItems(): array
    {
        return [
            [
                'id' => 1,
                'price' => 100,
                'weight' => 11,
            ],
            [
                'id' => 2,
                'price' => 200.5,
                'weight' => 22,
            ],
            [
                'id' => 3,
                'price' => 300,
                'weight' => 33.3,
            ],
        ];
    }

    private function getItemsPrice(array $items): float
    {
        return (float) array_sum(array_column($items, 'price'));
    }
}
