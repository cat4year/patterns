<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

class LegalCustomerFactory implements CustomerFactoryInterface
{
    public function createDelivery(): DeliveryInterface
    {
        return new LegalDelivery();
    }

    public function createPayment(): PaymentInterface
    {
        return new LegalPayment();
    }
}
