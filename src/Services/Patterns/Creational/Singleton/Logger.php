<?php

declare(strict_types=1);

namespace App\Services\Patterns\Creational\Singleton;

use App\Services\Technical\Printer;

class Logger
{
    private static ?self $instance = null;

    protected function __construct(private Printer $printer)
    {
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * @todo: можно ли заменить new self(app()->container()->get(Printer::class));
     * @todo: на app()->container()->get(Logger::class); ?
     */
    public static function getInstance(): ?Logger
    {
        if (!isset(self::$instance)) {
            self::$instance = new self(app()->container()->get(Printer::class));
        }

        return self::$instance;
    }

    public function info(string $message): void
    {
        $this->printer->scalar($message);
        $this->printer->blankLines();
    }
}