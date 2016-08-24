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
    public static function beginGridCol(array $cols, $options = [])
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
        return self::beginTag("div", $options);
    }
    
    public static function endGridCol() {
        return self::endTag("div");
    }

    public static function beginGridRow($options = []) {
        $class = "row";
        $options['class'] = isset($options['class'])
            ? $options['class'] ." ". $class 
            : $class;
        return self::beginTag("div", $options);
    }
    
    public static function endGridRow() {
        return self::endTag("div");
    }
    
    public static function grid(array $cols, array $contents) {
        $html = "";
        foreach ($contents as $i => $colContent) {
            if (isset($cols[$i])) {
                $args = [ $cols[$i] ];
            } else {
                $args = [];
                foreach ($cols as $z => $col) {
                    $args[$z] = $col[$i];
                }
            }
            $html .= self::beginGridCol($args) .$colContent. self::endGridCol();
        }
        return self::beginGridRow() .$html. self::endGridRow();
    }
}