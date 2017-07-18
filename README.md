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
            'categoryModel' => 'dvizh\shop\models\Category',
            'rightBlockWidgets' => [
                    [
                        'widget' => '\dvizh\cart\widgets\ElementsList',
                        'settings' => ['columns' => '3', 'showCountArrows' => false, 'type' => 'full']
                    ],
                    [
                        'widget' => '\dvizh\promocode\widgets\Enter',
                        'settings' => null
                    ],
                    [
                        'widget' => '\dvizh\cart\widgets\CartInformer',
                        'settings' => ['htmlTag' => 'span', 'text' => '{c} на {p}']
                    ],
                    [
                        'widget' => '\dvizh\order\widgets\OrderFormLight',
                        'settings' => ['useAjax' => true],
                    ]
            ]
        ],
        //...

  'components' => [
        'sws' => [
            'class' => 'halumein\sws\Sws',
        ],
        //...
    ]
```

Пример конфига с подключенными виджетами:

```php
    'modules' => [
        'sws' => [
            'class' => 'halumein\sws\Module',
            'categoryModel' => 'dvizh\shop\models\Category',
            'rightBlockWidgets' => [
                    [
                        'widget' => '\dvizh\cart\widgets\ElementsList',
                        'settings' => ['columns' => '3', 'showCountArrows' => false, 'type' => 'full']
                    ],
                    [
                        'widget' => '\dvizh\promocode\widgets\Enter',
                        'settings' => null
                    ],
                    [
                        'widget' => '\dvizh\cart\widgets\CartInformer',
                        'settings' => ['htmlTag' => 'span', 'text' => '{c} на {p}']
                    ],
                    [
                        'widget' => '\dvizh\order\widgets\OrderFormLight',
                        'settings' => ['useAjax' => true],
                    ]
            ]
        ],
    //...
    ]

```

дальше обращаться по адресу sws/<имя_контроллера>
