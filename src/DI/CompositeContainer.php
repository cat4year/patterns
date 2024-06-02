<?php

namespace App\DI;

use DI\ContainerBuilder;
use Exception;
use Psr\Container\ContainerInterface;

class CompositeContainer implements ContainerInterface
{
    /** @var array<string, ContainerInterface> */
    private array $containers = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->addPhpDiContainer();
    }

    public function get($id)
    {
        foreach ($this->containers as $container) {
            if ($container->has($id)) {
                return $container->get($id);
            }
        }

        throw new NotFoundContainerException($id);
    }

    public function has($id): bool
    {
        foreach ($this->containers as $container) {
            if ($container->has($id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @throws Exception
     */
    private function addPhpDiContainer(): void
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__ . '/../../di.config.php');
        $this->containers[] = $builder->build();
    }
}
