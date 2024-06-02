<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Creational;

use App\App;
use App\Services\Patterns\Creational\FactoryMethod\CustomerInterface;
use App\Services\Patterns\Creational\FactoryMethod\IndividualCustomer;
use App\Services\Patterns\Creational\FactoryMethod\LegalCustomer;
use App\Services\Technical\Printer;

readonly class FactoryMethodController
{
    public function __construct(private Printer $printer, private App $app)
    {
    }

    /**
     * Показываю реализацию фабричного метода на примере покупателя и функционала платежей
     * Интерфейсы упрощенны, и не являются достаточными для реальной работы
     */
    public function show(): void
    {
        $this->printer->heading('Реализация фабричного метода функционала платежей для покупателя', 1);
        $this->execute($this->app->container()->get(IndividualCustomer::class));
        $this->printer->blankLines(2);
        $this->execute($this->app->container()->get(LegalCustomer::class));
    }

    private function execute(CustomerInterface $factory): void
    {
        $this->printer->heading($factory::class, 2);

        $factory->showPayment();
    }
}
