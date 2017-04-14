<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * BaseIcon provides concrete implementation for [[Icon]].
 *
 * Do not use BaseIcon. Use [[Icon]] instead.
 *
 * @see http://getbootstrap.com/components/#glyphicons
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0.4
 */
class BaseIcon
{
    /**
     * Composes icon HTML.
     * Icon specification can be:
     * - string short name, which will be used to compose glyphicon HTML, for example: 'star'
     * - string HTML content, which will be used as it is, for example: '<i class="my-icon"></i>'
     * - array configuration for the tag, which should compose the icon, for example: `['tag' => 'i', 'class' => 'my-icon']`
     * @param string|array $icon icon specification.
     * @return string icon HTML.
     */
    public static function icon($icon)
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
     * Composes label with an icon attached.
     * This method is useful composing the labels, which contain icons, for the bootstrap widgets.
     * For example:
     *
     * ~~~php
     * echo Button::widget([
     *     'encodeLabel' => false, // disable widget label encoding
     *     'label' => Icon::label('ok-sign', 'Approve'),
     * ]);
     * ~~~
     *
     * Note: while working with widget, make sure you disable its internal label encoding, so it
     * displays icon HTML correctly.
     *
     * @param string|array $icon icon specification, see [[icon()]] for details.
     * @param string $label the label text.
     * @param array $options label composition options:
     * - encode: boolean, optional, whether the label text should be HTML-encoded
     * - template: string, optional, label composition template containing tokens `{icon}` and `{label}`
     * @return string label HTML.
     */
    public static function label($icon, $label, $options = [])
    {
        $options = array_merge(
            [
                'encode' => true,
                'template' => '{icon} {label}',
            ],
            $options
        );
        return strtr($options['template'], [
            '{icon}' => static::icon($icon),
            '{label}' => $options['encode'] ? Html::encode($label) : $label,
        ]);
    }
} 