<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\Builder;

class ProductBuilder implements ProductBuilderInterface
{
    private Product $product;

    public function __construct()
    {
        $this->reset();
    }

    private function reset(): void
    {
        $this->product = new Product();
    }

    public function name(string $name): ProductBuilderInterface
    {
        $this->product->setName($name);

        return $this;
    }

    public function price(float $price): ProductBuilderInterface
    {
        $this->product->setPrice($price);

        return $this;
    }

    public function tags(array $tags): ProductBuilderInterface
    {
        $this->product->setTags($tags);

        return $this;
    }

    public function characteristics(array $characteristics): ProductBuilderInterface
    {
        $this->product->setCharacteristics($characteristics);

        return $this;
    }

    public function picture(array $picture): ProductBuilderInterface
    {
        $this->product->setPicture($picture);

        return $this;
    }

    public function slider(array $pictures): ProductBuilderInterface
    {
        $this->product->setSlider($pictures);

        return $this;
    }

    public function seo(array $seoOptions): ProductBuilderInterface
    {
        $this->product->setSeo($seoOptions);

        return $this;
    }

    public function getProduct(): Product
    {
        $product = $this->product;
        $this->reset();

        return $product;
    }
}
