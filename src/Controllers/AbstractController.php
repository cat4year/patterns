<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\Technical\Printer;
use Psr\Container\ContainerInterface;

abstract readonly class AbstractController
{
    protected ContainerInterface $container;

    public function __construct(
        protected Printer $printer,
    ) {
        $this->container = app()->container();
    }

    abstract public function show(): void;
}
