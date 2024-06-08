<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Creational;

use App\Controllers\AbstractController;
use App\Services\Patterns\Creational\Prototype\PreviewProduct;

readonly class PrototypeController extends AbstractController
{
    /**
     * Реализация паттерна прототип на примере клонирования товара
     */
    public function show(): void
    {
        $this->printer->heading('Реализация паттерна прототип', 1);
        $this->execute();
    }

    private function execute(): void
    {
        $this->printer->heading('Базовый объект', 2);
        $previewProduct = new PreviewProduct('Горошек',
            155.5,
            ['Акция', 'Хит продаж'],
            ['url' => 'https://example.com/goroshek.jpg', 'alt' => 'Горошек'],
            15);
        $this->printer->array('Данные', $previewProduct->toArray());

        $this->printer->heading('Клонированный объект', 2);
        $previewProductClone = clone $previewProduct;
        $this->printer->array('Данные', $previewProductClone->toArray());
    }
}
