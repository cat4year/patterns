<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\FactoryMethod;

use App\Services\Technical\Printer;

abstract readonly class Customer implements CustomerInterface
{
    public function __construct(private Printer $printer)
    {
    }

    abstract public function createPayment(): PaymentInterface;

    public function showPayment(): void
    {
        $payment = $this->createPayment();

        $this->printer->heading('Вывод информации платежного сервиса', 2);
        $this->printer->array('Методы оплаты', $payment->getMethods());
        $this->printer->blankLines();
        $this->printer->descriptionValue('VAT', $payment->getVat());
    }
}
