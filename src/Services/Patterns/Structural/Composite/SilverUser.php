<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Composite;

class SilverUser extends Referral
{
    protected array $ratioForLvls = [
        1 => '0.01',
        2 => '0.001',
    ];
}