<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\AbstractFactory;

class LegalPayment implements PaymentInterface
{
    public function getMethods(): array
    {
        return ['Наложенный платеж', 'Банковский перевод'];
    }

    public function getVat(): float
    {
        return 30;
    }
}
