<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\Builder;

readonly class ProductManager
{
    public function __construct(private ProductBuilderInterface $builder)
    {
    }

    public function createPreviewProduct(): Product
    {
        return $this->builder->name('Горошек')
            ->price(155.5)
            ->tags(['Акция', 'Хит продаж'])
            ->picture(['url' => 'https://example.com/goroshek.jpg', 'alt' => 'Горошек'])
            ->getProduct();
    }

    public function createDetailProduct(): Product
    {
        return $this->builder->name('Горошек')
            ->price(155.5)
            ->seo(['title' => 'Горошек', 'description' => 'Топовый горошек'])
            ->tags(['Акция', 'Хит продаж'])
            ->characteristics(['Вес' => 1.5, 'Срок годности' => '3 месяца'])
            ->picture(['url' => 'https://example.com/goroshek.jpg', 'alt' => 'Горошек'])
            ->slider([
                ['url' => 'https://example.com/goroshek.jpg', 'alt' => 'Горошек'],
                ['url' => 'https://example.com/goroshek2.jpg', 'alt' => 'Горошек в профиль'],
            ])
            ->getProduct();
    }

    public function createOrderProduct(): Product
    {
        return $this->builder->name('Горошек')
            ->price(155.5)
            ->picture(['url' => 'https://example.com/goroshek.jpg', 'alt' => 'Горошек'])
            ->getProduct();
    }
}
