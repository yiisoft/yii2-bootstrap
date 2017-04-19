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
    /**
     * 
     * @param array $cols array of sizes columns. May be in format:
     *  [2,4,6,8] - generate: 'col-xs-2 col-sm-4 col-md-6 col-lg-8'
     *  or
     *  [
     *      'xs' => 12
     *      'lg' => 6,
     *  ] - generate: 'col-xs-12 col-lg-6'
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * Set 'class' attribute equal 'row'. If this attribute exist, 'row' added to existing value.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     * @return string the generated grid col start tag.
     * @see endGridCol()
     */
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
    
    /**
     * Generates a grid col (div) end tag.
     * @return string the generated tag
     * @see beginGridCol()
     */
    public static function endGridCol() {
        return self::endTag("div");
    }

    /**
     * Generates a grid row start tag.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * Set 'class' attribute equal 'row'. If this attribute exist, 'row' added to existing value.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     * @return string the generated grid row start tag.
     * @see endGridRow()
     */
    public static function beginGridRow($options = []) {
        $class = "row";
        $options['class'] = isset($options['class'])
            ? $options['class'] ." ". $class 
            : $class;
        return self::beginTag("div", $options);
    }
    
    /**
     * Generates a grid row (div) end tag.
     * @return string the generated tag
     * @see beginGridRow()
     */
    public static function endGridRow() {
        return self::endTag("div");
    }
    
    /**
     * Generates a grid html
     * @param array $cols array of sizes columns. May be in format:
     *  [2,4,6] - generate: 'col-xs-2', 'col-xs-4', etc.
     *  or
     *  [
     *      'xs' => [6,6,12],
     *      'sm' => [4,4,4],
     *  ] - generate: 'col-xs-6 col-sm-4', 'col-xs-6 col-sm-4', etc.
     * Count sizes column, must be equal of contents count.
     * @param array $contents column's content.
     * @return string the generated grid html
     */
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