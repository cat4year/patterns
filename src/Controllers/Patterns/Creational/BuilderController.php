<?php

declare(strict_types=1);

namespace App\Controllers\Patterns\Creational;

use App\Controllers\AbstractController;
use App\Services\Patterns\Creational\Builder\ProductManager;

readonly class BuilderController extends AbstractController
{
    /**
     * Показываю реализацию строителя на примере создания товаров разных типов
     * Будем собирать превью товар, детальный товар, товар корзины
     * Интерфейсы упрощенны, и не являются достаточными для реальной работы
     *
     * В данный момент в ProductManager'е логично создавать только какой-то шаблон товара или фикстуру
     * Возможно стоит прокидывать аргументы каждому методу, но тогда мы возвращаемся к проблеме большого конструктора
     *
     * Для создания типов товаров можно прокидывать 1 аргумент с опциями в виде массива или объекта
     * Основное использование и выгода строителя будет видна в клиентском коде, если нам нужно будет выйти за пределы
     * работы с 3мя шаблонами товаров
     */
    public function show(): void
    {
        $this->printer->heading('Реализация паттерна строитель на примере репозитория товара', 1);
        $this->execute($this->container->get(ProductManager::class));
    }

    private function execute(ProductManager $productManager): void
    {
        $this->printer->heading('Превью карточка товара', 2);
        $previewProduct = $productManager->createPreviewProduct();
        $this->printer->array('Данные', $previewProduct->toArray());

        $this->printer->heading('Детальная карточка товара', 2);
        $detailProduct = $productManager->createDetailProduct();
        $this->printer->array('Данные', $detailProduct->toArray());

        $this->printer->heading('Товар в заказе', 2);
        $orderProduct = $productManager->createOrderProduct();
        $this->printer->array('Данные', $orderProduct->toArray());
    }
}
