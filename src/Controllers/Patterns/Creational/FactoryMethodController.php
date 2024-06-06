<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Creational;

use App\Controllers\AbstractController;
use App\Services\Patterns\Creational\FactoryMethod\CustomerInterface;
use App\Services\Patterns\Creational\FactoryMethod\IndividualCustomer;
use App\Services\Patterns\Creational\FactoryMethod\LegalCustomer;

readonly class FactoryMethodController extends AbstractController
{
    /**
     * Показываю реализацию фабричного метода на примере покупателя и функционала платежей
     * Интерфейсы упрощенны, и не являются достаточными для реальной работы
     */
    public function show(): void
    {
        $this->printer->heading('Реализация фабричного метода функционала платежей для покупателя', 1);
        $this->execute($this->container->get(IndividualCustomer::class));
        $this->printer->blankLines(2);
        $this->execute($this->container->get(LegalCustomer::class));
    }

    private function execute(CustomerInterface $factory): void
    {
        $this->printer->heading($factory::class, 2);

        $factory->showPayment();
    }
}
