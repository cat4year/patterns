<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

interface CustomerFactoryInterface
{
    public function createDelivery(): DeliveryInterface;

    public function createPayment(): PaymentInterface;
}
