<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Composite;

class GoldenUser extends Referral
{
    protected array $ratioForLvls = [
        1 => '0.025',
        2 => '0.005',
        3 => '0.001',
    ];
}