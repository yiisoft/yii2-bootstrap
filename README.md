<p align="center">
    <a href="https://getbootstrap.com/docs/3.4/" target="_blank" rel="external">
        <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" height="80px">
    </a>
    <h1 align="center">Twitter Bootstrap Extension for Yii 2</h1>
    <br>
</p>

This is the Twitter Bootstrap extension for [Yii framework 2.0](https://www.yiiframework.com). It encapsulates [Bootstrap 3](https://getbootstrap.com/docs/3.4/) components
and plugins in terms of Yii widgets, and thus makes using Bootstrap components/plugins
in Yii applications extremely easy.

For license information check the [LICENSE](LICENSE.md)-file.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-bootstrap/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-bootstrap)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-bootstrap/downloads.png)](https://packagist.org/packages/yiisoft/yii2-bootstrap)
[![Build Status](https://github.com/yiisoft/yii2-bootstrap/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-bootstrap/actions)
[![codecov](https://codecov.io/gh/yiisoft/yii2-bootstrap/graph/badge.svg?token=WgenN23NcE)](https://codecov.io/gh/yiisoft/yii2-bootstrap)

Requirements
------------

- PHP 7.3 or higher.

Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiisoft/yii2-bootstrap
```

or add

```
"yiisoft/yii2-bootstrap": "~2.0.0"
```

to the require section of your `composer.json` file.

Usage
----

For example, the following
single line of code in a view file would render a Bootstrap Progress plugin:

```php
<?= yii\bootstrap\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
```
