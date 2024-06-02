<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\FactoryMethod;

interface CustomerInterface
{
    public function showPayment(): void;

    public function createPayment(): PaymentInterface;
}
