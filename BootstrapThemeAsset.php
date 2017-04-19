<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap default theme.
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class BootstrapThemeAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->css = [
            'css/bootstrap-theme' . (YII_DEBUG ? '' : '.min') . '.css',
        ];

        parent::init();
    }
}
