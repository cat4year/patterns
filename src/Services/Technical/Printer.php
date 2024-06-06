<?php

declare(strict_types=1);

namespace App\Services\Technical;

class Printer
{
    public function array(string $name, array $array, int $spaceCount = 0): void
    {
        $headingSpaceCount = $spaceCount > 0 ? $spaceCount - 1 : 0;
        $valueSpaceCount = $spaceCount > 0 ? $spaceCount + 1 : 0;

        $this->heading(str_repeat('&nbsp;', $headingSpaceCount) . $name . ':', 4);

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->array((string) $key, $value, ++$spaceCount);
                continue;
            }
            $key = str_repeat('&nbsp;', $valueSpaceCount) . $key;
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

    public function heading(float|int|string|bool $value, int $level = 3): void
    {
        echo sprintf('<h%d>%s</h%d>', $level, $value, $level);
    }
}
