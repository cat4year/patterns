<?php

namespace App\DI;

use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class NotFoundContainerException extends \Exception implements NotFoundExceptionInterface
{
    public function __construct(string $id, ?Throwable $previous = null)
    {
        $message = sprintf('Container %s not found', $id);
        parent::__construct($message, previous: $previous);
    }
}
