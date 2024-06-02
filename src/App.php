<?php

namespace App;

use App\DI\CompositeContainer;
use Psr\Container\ContainerInterface;

class App
{
    private ?ContainerInterface $container = null;

    public function container(): CompositeContainer
    {
        if (null === $this->container) {
            $this->container = new CompositeContainer();
        }

        return $this->container;
    }
}
