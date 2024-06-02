<?php

declare(strict_types=1);

namespace App\Services\Technical;

class Printer
{
    public function array(string $name, array $array): void
    {
        $this->heading($name . ':', 4);
        foreach ($array as $key => $value) {
            $this->descriptionValue($key, $value);
            $this->blankLines();
        }
    }

    public function blankLines(int $count = 1): void
    {
        echo str_repeat('<br>', $count);
    }

    public function scalar(float|int|string|bool $value): void
    {
        echo $value;
    }

    public function descriptionValue(string|int $description, float|int|string|bool $value): void
    {
        echo sprintf('<b>%s</b>: %s', $description, $value);
    }

    public function heading(float|int|string|bool $value, int $count = 3): void
    {
        echo sprintf('<h%d>%s</h%d>', $count, $value, $count);
    }
}
