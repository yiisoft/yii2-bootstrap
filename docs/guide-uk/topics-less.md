Використання .less файлів в Bootstrap
=====================================

Якщо ви хочете включити [CSS Bootstrap напряму до ваших less файлів](https://getbootstrap.com/docs/3.4/customize/)
вам необхідно відключити завантаження оригінальних css файлів bootstrap.
Ви можете зробити це, встановивши CSS властивість [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] порожньою.
Для цього вам необхідно налаштувати [компонент додатка](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md)
`assetManager` наступним чином:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
