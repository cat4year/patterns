<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

class LegalDelivery implements DeliveryInterface
{
    public function getMethods(): array
    {
        return ['Железнодорожная', 'Морская'];
    }

    public function getPrice(string $method): float
    {
        return match ($method) {
            'Железнодорожная' => 10000,
            'Морская' => 15000,
            default => 20000,
        };
    }
}
