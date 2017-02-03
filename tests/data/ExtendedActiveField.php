<?php
namespace yiiunit\extensions\bootstrap\data;

use yii\bootstrap\ActiveField;

/**
 * A customized extension from ActiveField
 *
 * @author Michael Härtl <haertl.mike@gmail.com>
 */
class ExtendedActiveField extends ActiveField
{
    public $horizontalCssClasses = [
        'offset' => 'col-md-offset-4',
        'label' => 'col-md-4',
        'wrapper' => 'col-md-4',
        'error' => 'col-md-3',
        'hint' => 'col-md-3',
    ];
}

