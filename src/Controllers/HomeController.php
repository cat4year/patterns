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

<h3>Порождающие</h3>
<a href="/creational/factory-method">Фабричный метод</a><br>
<a href="/creational/abstract-factory">Абстрактный фабричный метод</a><br>
<a href="/creational/builder">Строитель</a><br>
<a href="/creational/prototype">Прототип</a><br>
<a href="/creational/singleton">Одиночка</a><br>

<h3>Структурные</h3>
<a href="/structural/adapter">Адаптер</a><br>
<a href="/structural/bridge">Мост</a><br>
<a href="/structural/composite">Компоновщик</a><br>
</body>
</html>';
    }
}
