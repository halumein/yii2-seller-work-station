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
            'categoryModel' => 'pistol88\shop\models\Category',
            'rightBlockWidgets' => [
                    [
                        'widget' => '\pistol88\cart\widgets\ElementsList',
                        'settings' => ['columns' => '3', 'showCountArrows' => false, 'type' => 'full']
                    ],
                    [
                        'widget' => '\pistol88\promocode\widgets\Enter',
                        'settings' => null
                    ],
                    [
                        'widget' => '\pistol88\cart\widgets\CartInformer',
                        'settings' => ['htmlTag' => 'span', 'text' => '{c} на {p}']
                    ],
                    [
                        'widget' => '\pistol88\order\widgets\OrderFormLight',
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
            'categoryModel' => 'pistol88\shop\models\Category',
            'rightBlockWidgets' => [
                    [
                        'widget' => '\pistol88\cart\widgets\ElementsList',
                        'settings' => ['columns' => '3', 'showCountArrows' => false, 'type' => 'full']
                    ],
                    [
                        'widget' => '\pistol88\promocode\widgets\Enter',
                        'settings' => null
                    ],
                    [
                        'widget' => '\pistol88\cart\widgets\CartInformer',
                        'settings' => ['htmlTag' => 'span', 'text' => '{c} на {p}']
                    ],
                    [
                        'widget' => '\pistol88\order\widgets\OrderFormLight',
                        'settings' => ['useAjax' => true],
                    ]
            ]
        ],
    //...
    ]

```

дальше обращаться по адресу sws/<имя_контроллера>
