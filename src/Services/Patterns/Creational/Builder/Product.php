<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\Builder;

class Product
{
    private string $name = '';

    private float $price = 0;

    private array $tags = [];

    private array $characteristics = [];

    private array $picture = [];

    private array $slider = [];

    private array $seo = [];

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

    public function getCharacteristics(): array
    {
        return $this->characteristics;
    }

    public function setCharacteristics(array $characteristics): void
    {
        $this->characteristics = $characteristics;
    }

    public function getPicture(): array
    {
        return $this->picture;
    }

    public function setPicture(array $picture): void
    {
        $this->picture = $picture;
    }

    public function getSlider(): array
    {
        return $this->slider;
    }

    public function setSlider(array $slider): void
    {
        $this->slider = $slider;
    }

    public function getSeo(): array
    {
        return $this->seo;
    }

    public function setSeo(array $seo): void
    {
        $this->seo = $seo;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'tags' => $this->getTags(),
            'characteristics' => $this->getCharacteristics(),
            'picture' => $this->getPicture(),
            'slider' => $this->getSlider(),
            'seo' => $this->getSeo(),
        ];
    }
}