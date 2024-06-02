<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController
{
    public function show(): string
    {
        return '<html lang="ru">
<body>
<h1>Главная</h1>
<a href="/creational/abstract-factory">Абстрактный фабричный метод</a>
</body>
</html>';
    }
}
