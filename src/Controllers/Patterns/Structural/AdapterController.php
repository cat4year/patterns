<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Structural;

use App\Controllers\AbstractController;
use App\Services\Patterns\Structural\Adapter\DeliveryFirstGetawayAdapter;
use App\Services\Patterns\Structural\Adapter\DeliveryGetawayInterface;
use App\Services\Patterns\Structural\Adapter\DeliverySecondGetawayAdapter;

readonly class AdapterController extends AbstractController
{
    /**
     * Реализация паттерна Адаптер на примере 2ух апи сервисов доставки
     * Интерфейсы упрощенны, и не являются достаточными для реальной работы
     */
    public function show(): void
    {
        $this->printer->heading('Реализация паттерна Адаптер на примере 2ух апи сервисов доставки', 1);
        $this->execute($this->container->get(DeliveryFirstGetawayAdapter::class));
        $this->printer->blankLines(2);
        $this->execute($this->container->get(DeliverySecondGetawayAdapter::class));
    }

    /**
     * @param DeliveryGetawayInterface $deliveryGetaway
     * @return void
     */
    private function execute(DeliveryGetawayInterface $deliveryGetaway): void
    {
        $this->printer->heading($deliveryGetaway::class, 2);

        $items = $this->getFakeItems();
        $from = 111;
        $to = 222;

        $tariffs = $deliveryGetaway->getTariffs();
        $this->printer->array('Тарифы', $tariffs);
        $this->printer->blankLines();

        foreach ($tariffs as $tariffCode => $tariffRate) {
            $shippingCost = $deliveryGetaway->calculateShippingCost($tariffCode, $from, $to);
            $this->printer->descriptionValue('Стоимость доставки', $shippingCost);
            $this->printer->blankLines();

            if ($shippingCost > 0) {
                $orderId = $deliveryGetaway->order($tariffCode, $items, $from, $to);
                $this->printer->descriptionValue('Заказ принят.Номер заказа', $orderId);
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
}
