<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use Yii;
use yii\helpers\Html;

/**
 * Icon renders an glyphicon bootstrap component.
 *
 * For example,
 *
 * ```php
 * echo Icon::widget([
 *     'icon' => 'plus-sign',
 *     'tag' => 'i',
 * ]);
 * ```
 *
 * @see http://getbootstrap.com/components/#glyphicons
 * @author Maxim Tikhonov <bnr17@yandex.ru>
 * @since 2.0
 */
class Icon extends Widget
{
    /**
     * @var string the icon to display. Use second part of glyphicon's name.
     * Example: For display "glyphicon glyphicon-plus" image use only "plus" part.
     */
    public $icon;
    /**
     * @var string the tag for display icon.
     * By default "i" tag used.
     */
    public $tag = 'i';
    /**
     * @var boolean the flag to add final blank "&nbsp;" after tag
     */
    public $insertBlank = true;
    /**
     * @var array the tag's options.
     */
    public $options = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        $this->initOptions();

        echo Html::beginTag($this->tag, $this->options);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {        
        echo Html::endTag($this->tag);
        if ($this->insertBlank) echo '&nbsp;';

        $this->registerPlugin('icon');
    }


    /**
     * Initializes the widget options.
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        Html::addCssClass($this->options, 'glyphicon glyphicon-' . $this->icon);        
    }
}
