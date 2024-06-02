<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

class IndividualCustomerFactory implements CustomerFactoryInterface
{
    public function createDelivery(): DeliveryInterface
    {
        return new IndividualDelivery();
    }

    public function createPayment(): PaymentInterface
    {
        return new IndividualPayment();
    }
}
