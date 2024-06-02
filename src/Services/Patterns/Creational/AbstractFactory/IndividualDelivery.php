<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

class IndividualDelivery implements DeliveryInterface
{
    public function getMethods(): array
    {
        return ['Самовывоз', 'Курьер'];
    }

    public function getPrice(string $method): float
    {
        return match ($method) {
            'Самовывоз' => 0,
            'Курьер' => 200,
            default => 1000,
        };
    }
}
