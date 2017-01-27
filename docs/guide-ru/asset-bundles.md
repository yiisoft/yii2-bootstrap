Asset Bundles
=============

Bootstrap это комплексное front-end решение, включающее CSS, JavaScript, шрифты и т.д.
Для того чтобы обеспечить вам самый гибкий контроль над компонентами Bootstrap, это расширение предоставляет несколькоо asset bundles.
Вот они:

- [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] - содержит CSS файлы.
- [[yii\bootstrap\BootstrapPluginAsset|BootstrapPluginAsset]] - зависит от [[yii\bootstrap\BootstrapAsset]], содержащий javascript файлы.
- [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] - зависит от [[yii\bootstrap\BootstrapAsset]], содержащий Bootstrap CSS темы по умолчанию.

Particular application needs may require different bundle (or bundle combination) usage.
Если вам нужны только CSS стили, [[yii\bootstrap\BootstrapAsset]] будет достаточно для вас. Тем не менее, если вы хотите использовать Bootstrap JavaScript, вам необходимо зарегистрировать [[yii\bootstrap\BootstrapPluginAsset]].

> Tip: большинство виджетов регистрируются [[yii\bootstrap\BootstrapPluginAsset]] автоматически.
