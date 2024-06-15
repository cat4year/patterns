<?php

namespace App\DI;

use DI\ContainerBuilder;
use Exception;
use Invoker\Exception\InvocationException;
use Invoker\Exception\NotCallableException;
use Invoker\Exception\NotEnoughParametersException;
use Invoker\InvokerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

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
     * @param $callable
     * @param array $parameters
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws InvocationException
     * @throws NotCallableException
     * @throws NotEnoughParametersException
     * @throws NotFoundContainerException
     * @throws NotFoundExceptionInterface
     */
    public function call($callable, array $parameters = []): mixed
    {
        $invoker = $this->get(InvokerInterface::class);
        if ($invoker === false) {
            throw new NotFoundContainerException(InvokerInterface::class);
        }

        return $invoker->call($callable, $parameters);
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
