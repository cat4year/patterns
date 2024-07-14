<?php

declare(strict_types=1);

namespace App\Services\Patterns\Structural\Composite;

use SplObjectStorage;

abstract class Referral
{
    protected ?Referral $referrer;
    protected SplObjectStorage $referrals;

    protected array $ratioForLvls;

    public function __construct(protected float $earnedMoney)
    {
        $this->referrals = new SplObjectStorage();
    }

    public function setReferrer(?self $referrer): void
    {
        $this->referrer = $referrer;
    }

    public function getReferrer(): self
    {
        return $this->referrer;
    }

    public function add(self $component): void
    {
        $this->referrals->attach($component);
        $component->setReferrer($this);
    }

    public function remove(self $component): void
    {
        $this->referrals->detach($component);
        $component->setReferrer(null);
    }

    public function getEarnedMoney(): float
    {
        return $this->earnedMoney;
    }

    public function getAmountOfMoneyFromReferrals(int $lvl = 1): float
    {
        if ($lvl > array_key_last($this->ratioForLvls)) {
            return 0;
        }

        $totalEarnedMoneyForReferrer = 0;

        foreach ($this->referrals as $referral) {
            $totalEarnedMoneyForReferrer += $referral->getEarnedMoney() * $this->ratioForLvls[$lvl];
            $totalEarnedMoneyForReferrer += $referral->getAmountOfMoneyFromReferrals($lvl + 1);
        }

        return $totalEarnedMoneyForReferrer;
    }

    public function getAmountEarnedMoneyByReferrals(int $lvl = 1): float
    {
        if ($lvl > array_key_last($this->ratioForLvls)) {
            return 0;
        }

        $totalEarnedMoney = 0;

        foreach ($this->referrals as $referral) {
            $totalEarnedMoney += $referral->getEarnedMoney();
            $totalEarnedMoney += $referral->getAmountEarnedMoneyByReferrals($lvl + 1);
        }

        return $totalEarnedMoney;
    }
}