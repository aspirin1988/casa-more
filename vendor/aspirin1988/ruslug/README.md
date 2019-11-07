# Транслитерация для Laravel >= 5.4

Установка
-------
Добавьте в файл `composer.json` строку
"aspirin1988/ruslug": "~0.6.1"

    "require": {
        "aspirin1988/ruslug/": "~0.6.1"
    },

Затем выполните команду:
    `composer install`


Если у вас установлен Laravel 5.4 или более ранней версии, то в `app/config/app.php` нужно добавить провайдера:

  `Aspirin1988\Ruslug\RuslugServiceProvider::class,`

И добавить новый алиас:

  `'Slug'     => Aspirin1988\Ruslug\RuslugFacade::class,`

Использование
-------
Вызов метода: `\Slug::make($text)`
