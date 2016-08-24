<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

/**
 * Html is an enhanced version of [[\yii\helpers\Html]] helper class dedicated to the Bootstrap needs.
 * This class inherits all functionality available at [[\yii\helpers\Html]] and can be used as substitute.
 *
 * Attention: do not confuse [[\yii\bootstrap\Html]] and [[\yii\helpers\Html]], be careful in which class
 * you are using inside your views.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0.5
 */
class Html extends BaseHtml
{
    public static function beginGridCol($cols, $options = [])
    {
        $class = "";
        $sizes = ["xs","sm","md","lg"];
        foreach ($cols as $i => $count) {
            $size = is_integer($i) ? $sizes[$i] : $i;
            $class .= "col-{$size}-{$count} ";
        }
        $class = rtrim($class);
        $options['class'] = isset($options['class'])
            ? $options['class'] ." ". $class 
            : $class;
        return Html::beginTag("div", $options);
    }
    
    public static function endGridCol() {
        return Html::endTag("div");
    }

    public static function beginGridRow($options = []) {
        $class = "row";
        $options['class'] = isset($options['class'])
            ? $options['class'] ." ". $class 
            : $class;
        return Html::beginTag("div", $options);
    }
    
    public static function endGridRow() {
        return Html::endTag("div");
    }
}