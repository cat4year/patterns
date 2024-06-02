<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

interface PaymentInterface
{
    public function getMethods(): array;

    public function getVat(): float;
}
