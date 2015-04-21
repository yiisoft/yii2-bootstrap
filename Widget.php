<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * \yii\bootstrap\Widget is the base class for all bootstrap widgets.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Widget extends \yii\base\Widget
{
    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array the options for the underlying Bootstrap JS plugin.
     * Please refer to the corresponding Bootstrap plugin Web page for possible options.
     * For example, [this page](http://getbootstrap.com/javascript/#modals) shows
     * how to use the "Modal" plugin and the supported options (e.g. "remote").
     */
    public $clientOptions = [];
    /**
     * @var array the event handlers for the underlying Bootstrap JS plugin.
     * Please refer to the corresponding Bootstrap plugin Web page for possible events.
     * For example, [this page](http://getbootstrap.com/javascript/#modals) shows
     * how to use the "Modal" plugin and the supported events (e.g. "shown").
     */
    public $clientEvents = [];


    /**
     * Initializes the widget.
     * This method will register the bootstrap asset bundle. If you override this method,
     * make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Registers a specific Bootstrap plugin and the related events
     * @param string $name the name of the Bootstrap plugin
     */
    protected function registerPlugin($name)
    {
        $view = $this->getView();

        BootstrapPluginAsset::register($view);

        $id = $this->options['id'];

        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
            $js = "jQuery('#$id').$name($options);";
            $view->registerJs($js);
        }

        $this->registerClientEvents();
    }

    /**
     * Registers JS event handlers that are listed in [[clientEvents]].
     * @since 2.0.2
     */
    protected function registerClientEvents()
    {
        if (!empty($this->clientEvents)) {
            $id = $this->options['id'];
            $js = [];
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }
            $this->getView()->registerJs(implode("\n", $js));
        }
    }

    /**
     * Composes icon HTML.
     * Icon specification can be:
     * - string short name, which will be used to compose glyphicon HTML, for example: 'star'
     * - string HTML content, which will be used as it is, for example: '<i class="my-icon"></i>'
     * - array configuration for the tag, which should compose the icon, for example: `['tag' => 'i', 'class' => 'my-icon']`
     * @param string $icon icon short name or HTML.
     * @return string icon HTML.
     * @since 2.0.4
     */
    protected function icon($icon)
    {
        if (is_array($icon)) {
            $tag = ArrayHelper::remove($icon, 'tag', 'span');
            return Html::tag($tag, '', $icon);
        }
        if (strpos($icon, '<') !== false) {
            return $icon;
        }
        return Html::tag('span', '', ['class' => 'glyphicon glyphicon-' . $icon]);
    }

    /**
     * Composes label with icon HTML.
     * @param array $params label parameters:
     * - label: string, optional, the label text
     * - icon: string, optional, the label icon specification, see [[icon()]] for details
     * - encode: boolean, optional, whether the label text should be HTML-encoded
     * @throws InvalidConfigException if no label or icon option is specified.
     * @return string label HTML.
     * @since 2.0.4
     */
    protected function label(array $params)
    {
        if (!isset($params['icon']) && !isset($params['label'])) {
            throw new InvalidConfigException("The 'label' or 'icon' option is required.");
        }
        $label = '';
        if (isset($params['label'])) {
            $label .= (!isset($params['encode']) || $params['encode']) ? Html::encode($params['label']) : $params['label'];
        }
        if (isset($params['icon'])) {
            $label = $this->icon($params['icon']) . ' ' .$label;
        }
        return $label;
    }
}
