<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\Builder;

interface ProductBuilderInterface
{
    public function name(string $name): ProductBuilderInterface;

    public function price(float $price): ProductBuilderInterface;

    public function tags(array $tags): ProductBuilderInterface;

    public function characteristics(array $characteristics): ProductBuilderInterface;

    public function picture(array $picture): ProductBuilderInterface;

    public function slider(array $pictures): ProductBuilderInterface;

    public function seo(array $seoOptions): ProductBuilderInterface;

    public function getProduct(): Product;
}
