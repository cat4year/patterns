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
<a href="/creational/factory-method">Фабричный метод</a><br>
<a href="/creational/abstract-factory">Абстрактный фабричный метод</a><br>
<a href="/creational/builder">Строитель</a><br>
<a href="/creational/prototype">Прототип</a><br>
<a href="/creational/singleton">Одиночка</a><br>
</body>
</html>';
    }
}
