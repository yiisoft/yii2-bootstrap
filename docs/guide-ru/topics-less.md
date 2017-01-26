Использование .less файлов Bootstrap напрямую
===========================================

Если вы хотите включить [Bootstrap CSS непосредственно ываши less файлы](http://getbootstrap.com/getting-started/#customizing), вам может понадобится отключить исходные css bootstrap файлы из загрузки. Вы можете сделать это установив
[[yii\bootstrap\BootstrapAsset|BootstrapAsset]] свойство пустым.
Для этого вам необходимо настроить `assetManager` [компонент приложения](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md) следующим образом:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
