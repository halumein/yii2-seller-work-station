Yii2-seller-work-station
==========


```
php composer require halumein/yii2-seller-work-station "*"
```

миграции:

```
php yii migrate --migrationPath=vendor/halumein/yii2-seller-work-station/migrations
```

В конфигурационный файл приложения добавить модуль cashbox

```php
    'modules' => [
        'sws' => [
            'class' => 'halumein\sws\Module',
        ],
        //...

  'components' => [
        'sws' => [
            'class' => 'halumein\sws\Sws',
        ],
        //...
    ]
```

дальше обращаться по адресу sws/<имя_контроллера>
