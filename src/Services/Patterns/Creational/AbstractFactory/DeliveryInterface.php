<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

interface DeliveryInterface
{
    public function getMethods(): array;

    public function getPrice(string $method): float;
}
