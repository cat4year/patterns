<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Creational;

use App\Controllers\AbstractController;
use App\Services\Patterns\Creational\Singleton\Logger;

readonly class SingletonController extends AbstractController
{
    /**
     * Реализация паттерна одиночка на примере создания класса приложения
     */
    public function show(): void
    {
        $this->printer->heading('Реализация паттерна прототип', 1);
        $this->execute();
    }

    private function execute(): void
    {
        $this->printer->heading('Базовый объект', 2);
        $logger = Logger::getInstance();
        $logger->info('Тестовое сообщение');
    }
}
