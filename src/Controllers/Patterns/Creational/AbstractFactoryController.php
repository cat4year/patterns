<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Creational;

use App\Controllers\AbstractController;
use App\Services\Patterns\Creational\AbstractFactory\CustomerFactoryInterface;
use App\Services\Patterns\Creational\AbstractFactory\IndividualCustomerFactory;
use App\Services\Patterns\Creational\AbstractFactory\LegalCustomerFactory;

readonly class AbstractFactoryController extends AbstractController
{
    /**
     * Реализация абстрактной фабрики на примере семейств классов Физ. лица и Юр. лица
     * Интерфейсы упрощенны, и не являются достаточными для реальной работы
     */
    public function show(): void
    {
        $this->printer->heading('Реализация фабрики для 2ух типов плательщиков', 1);
        $this->executeFactory($this->container->get(IndividualCustomerFactory::class));
        $this->printer->blankLines(2);
        $this->executeFactory($this->container->get(LegalCustomerFactory::class));
    }

    private function executeFactory(CustomerFactoryInterface $factory): void
    {
        $this->printer->heading($factory::class, 2);

        $payment = $factory->createPayment();
        $delivery = $factory->createDelivery();

        $this->printer->heading('Информация по оплате');
        $this->printer->array('Методы оплаты', $payment->getMethods());
        $this->printer->blankLines();
        $this->printer->descriptionValue('VAT', $payment->getVat());

        $this->printer->heading('Информация по доставке');
        $deliveryMethods = $delivery->getMethods();
        $this->printer->array('Методы доставки', $deliveryMethods);
        $deliveryMethodsPrice = [];
        foreach ($deliveryMethods as $deliveryMethod) {
            $deliveryMethodsPrice[$deliveryMethod] = $delivery->getPrice($deliveryMethod);
        }
        $this->printer->array('Цена каждого метода доставки', $deliveryMethodsPrice);
    }
}
