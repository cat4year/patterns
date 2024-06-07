<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\Prototype;

class PreviewProduct
{
    public function __construct(
        private string $name = '',
        private float  $price = 0,
        private array  $tags = [],
        private array  $picture = [],
        private int    $sectionId = 0
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getPicture(): array
    {
        return $this->picture;
    }

    public function setPicture(array $picture): void
    {
        $this->picture = $picture;
    }

    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    public function setSectionId(int $sectionId): void
    {
        $this->sectionId = $sectionId;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'tags' => $this->getTags(),
            'picture' => $this->getPicture(),
            'sectionId' => $this->getSectionId(),
        ];
    }

    /**
     * Допустим будет устанавливать такое же название товара с пометкой (копия)
     * Очищаем цену, теги, изображение
     * Оставляем идентификатор раздела
     */
    public function __clone(): void
    {
        $this->name .= ' (копия)';
        $this->price = 0;
        $this->tags = [];
        $this->picture = [];
    }
}
