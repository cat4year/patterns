<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\FactoryMethod;

class IndividualPayment implements PaymentInterface
{
    public function getMethods(): array
    {
        return ['Безналичный расчет', 'При получении'];
    }

    public function getVat(): float
    {
        return 20;
    }
}
