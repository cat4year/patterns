<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\FactoryMethod;

readonly class IndividualCustomer extends Customer
{
    public function createPayment(): PaymentInterface
    {
        return new IndividualPayment();
    }
}
