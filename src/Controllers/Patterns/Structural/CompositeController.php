<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Structural;

use App\Controllers\AbstractController;
use App\Services\Patterns\Structural\Composite\GoldenUser;
use App\Services\Patterns\Structural\Composite\Referral;
use App\Services\Patterns\Structural\Composite\SilverUser;

readonly class CompositeController extends AbstractController
{
    /**
     * Реализация паттерна Компоновщик на примере Реферальной программы для разных типов юзеров
     */
    public function show(): void
    {
        $this->printer->heading('Реализация паттерна Компоновщик', 1);

        $this->execute(new GoldenUser(0));
        $this->printer->blankLines(2);
        $this->execute(new SilverUser(0));
    }

    private function execute(Referral $mainReferrer): void
    {
        $userReferralLvl1n1 = new SilverUser(100);
        $userReferralLvl2n1n1 = new SilverUser(200);
        $userReferralLvl2n1n2 = new SilverUser(500);
        $userReferralLvl1n1->add($userReferralLvl2n1n1);
        $userReferralLvl1n1->add($userReferralLvl2n1n2);
        $mainReferrer->add($userReferralLvl1n1);

        $userReferralLvl1n2 = new SilverUser(1000);
        $userReferralLvl2n2n1 = new SilverUser(2000);
        $userReferralLvl2n2n2 = new SilverUser(5000);
        $userReferralLvl1n2->add($userReferralLvl2n2n1);
        $userReferralLvl1n2->add($userReferralLvl2n2n2);
        $mainReferrer->add($userReferralLvl1n2);

        $this->printer->descriptionValue(
            'Сумма всех заработанных денег рефералами',
            $mainReferrer->getAmountEarnedMoneyByReferrals() . ' $'
        );
        $this->printer->blankLines();

        $this->printer->descriptionValue(
            'Сумма заработка с рефералов',
            $mainReferrer->getAmountOfMoneyFromReferrals() . ' $'
        );
    }
}
