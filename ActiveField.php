<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use yii\helpers\ArrayHelper;

/**
 * A Bootstrap 4 enhanced version of [[\yii\widgets\ActiveField]].
 *
 * This class adds some useful features to [[\yii\widgets\ActiveField|ActiveField]] to render all
 * sorts of Bootstrap 4 form fields in different form layouts:
 *
 * - [[inputTemplate]] is an optional template to render complex inputs, for example input groups
 * - [[inlineCssClasses]] defines the CSS inline classes to add to checkLabel, wrapper, input and hint
 *   in inline forms
 * - [[horizontalCssClasses]] defines the CSS grid classes to add to label, wrapper, error and hint
 *   in horizontal forms
 * - [[inline]]/[[inline()]] is used to render inline [[checkboxList()]] and [[radioList()]]
 * - [[enableError]] can be set to `false` to disable to the error
 * - [[enableLabel]] can be set to `false` to disable to the label
 * - [[label()]] can be used with a `boolean` argument to enable/disable the label
 *
 * There are also some new placeholders that you can use in the [[template]] configuration:
 *
 * - `{beginWrapper}`: the opening wrapper tag
 * - `{endWrapper}`: the closing wrapper tag
 *
 * The wrapper tag is only used for some layouts and form elements.
 *
 * Note that some elements use slightly different defaults for [[template]] and other options.
 * You may want to override those predefined templates for checkboxes, radio buttons, checkboxLists
 * and radioLists in the [[\yii\widgets\ActiveForm::fieldConfig|fieldConfig]] of the
 * [[\yii\widgets\ActiveForm]]:
 *
 * - [[checkboxTemplate]] the template for checkboxes in default layout
 * - [[radioTemplate]] the template for radio buttons in default layout
 * - [[horizontalCheckboxTemplate]] the template for checkboxes in horizontal layout
 * - [[horizontalRadioTemplate]] the template for radio buttons in horizontal layout
 *
 * Example:
 *
 * ```php
 * use yii\bootstrap\ActiveForm;
 *
 * $form = ActiveForm::begin(['layout' => 'horizontal']);
 *
 * // Form field without label
 * echo $form->field($model, 'demo', [
 *     'inputOptions' => [
 *         'placeholder' => $model->getAttributeLabel('demo'),
 *     ],
 * ])->label(false);
 *
 * // Inline radio list
 * echo $form->field($model, 'demo')->inline()->radioList($items);
 *
 * // Control sizing in horizontal mode
 * echo $form->field($model, 'demo', [
 *     'horizontalCssClasses' => [
 *         'wrapper' => 'col-sm-2',
 *     ]
 * ]);
 *
 * // With 'default' layout you would use 'template' to size a specific field:
 * echo $form->field($model, 'demo', [
 *     'template' => '{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div>'
 * ]);
 *
 * // Input group
 * echo $form->field($model, 'demo', [
 *     'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
 * ]);
 *
 * ActiveForm::end();
 * ```
 *
 * @see \yii\bootstrap\ActiveForm
 * @see http://getbootstrap.com/css/#forms
 *
 * @author Michael Härtl <haertl.mike@gmail.com>
 * @author Cosmo <daixianceng@gmail.com>
 * @since 2.0
 */
class ActiveField extends \yii\widgets\ActiveField
{
    /**
     * @var boolean whether to render [[checkboxList()]] and [[radioList()]] inline.
     */
    public $inline = false;
    /**
     * @var string|null optional template to render the `{input}` placeholder content
     */
    public $inputTemplate;
    /**
     * @var array options for the wrapper tag, used in the `{beginWrapper}` placeholder
     */
    public $wrapperOptions = [];
    /**
     * @var null|array CSS classes for inline layout. This must be an array with these keys:
     *  - 'checkLabel' the check label inline class
     *  - 'wrapper' the wrapper inline class
     *  - 'input' the input inline class
     *  - 'hint' the hint inline class
     */
    public $inlineCssClasses;
    /**
     * @var null|array CSS grid classes for horizontal layout. This must be an array with these keys:
     *  - 'offset' the offset grid class to append to the wrapper if no label is rendered
     *  - 'label' the label grid class
     *  - 'wrapper' the wrapper grid class
     *  - 'error' the error grid class
     *  - 'hint' the hint grid class
     */
    public $horizontalCssClasses;
    /**
     * @var string the template for checkboxes in default layout
     */
    public $checkboxTemplate = "{label}\n<div class=\"form-check\">\n{input}\n</div>\n{error}\n{hint}";
    /**
     * @var string the template for radios in default layout
     */
    public $radioTemplate = "{label}\n<div class=\"form-check\">\n{input}\n</div>\n{error}\n{hint}";
    /**
     * @var string the template for checkboxes in horizontal layout
     */
    public $horizontalCheckboxTemplate = "{label}\n{beginWrapper}\n<div class=\"form-check\">\n{input}\n</div>\n{error}\n{hint}\n{endWrapper}";
    /**
     * @var string the template for radio buttons in horizontal layout
     */
    public $horizontalRadioTemplate = "{label}\n{beginWrapper}\n<div class=\"form-check\">\n{input}\n</div>\n{error}\n{hint}\n{endWrapper}";
    /**
     * @var boolean whether to render the error. Default is `true` except for layout `inline`.
     */
    public $enableError = true;
    /**
     * @var boolean whether to render the label. Default is `true`.
     */
    public $enableLabel = true;


    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        $layoutConfig = $this->createLayoutConfig($config);
        $config = ArrayHelper::merge($layoutConfig, $config);
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function render($content = null)
    {
        if ($content === null) {
            if (!isset($this->parts['{beginWrapper}'])) {
                $options = $this->wrapperOptions;
                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $this->parts['{beginWrapper}'] = Html::beginTag($tag, $options);
                $this->parts['{endWrapper}'] = Html::endTag($tag);
            }
            if ($this->enableLabel === false) {
                $this->parts['{label}'] = '';
            }
            if ($this->enableError === false) {
                $this->parts['{error}'] = '';
            }
            if ($this->inputTemplate) {
                $input = isset($this->parts['{input}']) ?
                    $this->parts['{input}'] : Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
                $this->parts['{input}'] = strtr($this->inputTemplate, ['{input}' => $input]);
            }
        }
        return parent::render($content);
    }

    /**
     * @inheritdoc
     */
    public function checkbox($options = [], $enclosedByLabel = true)
    {
        if (!isset($options['class'])) {
            $options['class'] = 'form-check-input';
        }
        if (!isset($options['labelOptions'])) {
            $options['labelOptions'] = ['class' => 'form-check-label'];
            if ($this->form->layout === 'inline') {
                Html::addCssClass($options['labelOptions'], $this->inlineCssClasses['checkLabel']);
            }
        }
        if (!isset($options['template'])) {
            $this->template = $this->form->layout === 'horizontal' ?
                $this->horizontalCheckboxTemplate : $this->checkboxTemplate;
        } else {
            $this->template = $options['template'];
            unset($options['template']);
        }
        if ($enclosedByLabel) {
            $this->label(false);
        } else {
            $options['label'] = '';
        }

        Html::removeCssClass($this->labelOptions, 'col-form-label');
        parent::checkbox($options);
        unset($this->parts['{label}']);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function radio($options = [], $enclosedByLabel = true)
    {
        if (!isset($options['class'])) {
            $options['class'] = 'form-check-input';
        }
        if (!isset($options['labelOptions'])) {
            $options['labelOptions'] = ['class' => 'form-check-label'];
            if ($this->form->layout === 'inline') {
                Html::addCssClass($options['labelOptions'], $this->inlineCssClasses['checkLabel']);
            }
        }
        if (!isset($options['template'])) {
            $this->template = $this->form->layout === 'horizontal' ?
                $this->horizontalRadioTemplate : $this->radioTemplate;
        } else {
            $this->template = $options['template'];
            unset($options['template']);
        }
        if ($enclosedByLabel) {
            $this->label(false);
        } else {
            $options['label'] = '';
        }

        Html::removeCssClass($this->labelOptions, 'col-form-label');
        parent::radio($options);
        unset($this->parts['{label}']);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function checkboxList($items, $options = [])
    {
        if (!isset($options['itemOptions'])) {
            $options['itemOptions'] = [
                'labelOptions' => ['class' => 'form-check-label'],
                'class' => 'form-check-input',
            ];
        }
        if ($this->form->layout === 'inline' && !isset($options['class'])) {
            $options['class'] = 'd-inline-flex ' . $this->inlineCssClasses['input'];
        }
        if (!isset($options['item'])) {
            $itemOptions = $options['itemOptions'];
            $itemCssClass = 'form-check' . ($this->inline ? ' form-check-inline' : '');
            $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $itemCssClass) {
                $options = array_merge(['label' => $label, 'value' => $value], $itemOptions);
                return '<div class="' . $itemCssClass . '">' . Html::checkbox($name, $checked, $options) . '</div>';
            };
        }
        Html::removeCssClass($this->labelOptions, 'col-form-label');
        parent::checkboxList($items, $options);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function radioList($items, $options = [])
    {
        if (!isset($options['itemOptions'])) {
            $options['itemOptions'] = [
                'labelOptions' => ['class' => 'form-check-label'],
                'class' => 'form-check-input',
            ];
        }
        if ($this->form->layout === 'inline' && !isset($options['class'])) {
            $options['class'] = 'd-inline-flex ' . $this->inlineCssClasses['input'];
        }
        if (!isset($options['item'])) {
            $itemOptions = $options['itemOptions'];
            $itemCssClass = 'form-check' . ($this->inline ? ' form-check-inline' : '');
            $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $itemCssClass) {
                $options = array_merge(['label' => $label, 'value' => $value], $itemOptions);
                return '<div class="' . $itemCssClass . '">' . Html::radio($name, $checked, $options) . '</div>';
            };
        }
        Html::removeCssClass($this->labelOptions, 'col-form-label');
        parent::radioList($items, $options);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function fileInput($options = [])
    {
        Html::removeCssClass($this->inputOptions, 'form-control');
        Html::addCssClass($this->inputOptions, 'form-control-file');

        return parent::fileInput($options);
    }

    /**
     * Renders Bootstrap static form control.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. There are also a special options:
     *
     * - encode: boolean, whether value should be HTML-encoded or not.
     *
     * @return $this the field object itself
     * @since 2.0.5
     * @see http://getbootstrap.com/css/#forms-controls-static
     */
    public function staticControl($options = [])
    {
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeStaticControl($this->model, $this->attribute, $options);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function label($label = null, $options = [])
    {
        if (is_bool($label)) {
            $this->enableLabel = $label;
            if ($label === false && $this->form->layout === 'horizontal') {
                Html::addCssClass($this->wrapperOptions, $this->horizontalCssClasses['offset']);
            }
        } else {
            $this->enableLabel = true;
            parent::label($label, $options);
        }
        return $this;
    }

    /**
     * @param boolean $value whether to render a inline list
     * @return $this the field object itself
     * Make sure you call this method before [[checkboxList()]] or [[radioList()]] to have any effect.
     */
    public function inline($value = true)
    {
        $this->inline = (bool) $value;
        return $this;
    }

    /**
     * @param array $instanceConfig the configuration passed to this instance's constructor
     * @return array the layout specific default configuration for this instance
     */
    protected function createLayoutConfig($instanceConfig)
    {
        $config = [
            'hintOptions' => [
                'tag' => 'small',
                'class' => 'form-text text-muted',
            ],
            'errorOptions' => [
                'class' => 'form-control-feedback',
            ],
            'inputOptions' => [
                'class' => 'form-control',
            ],
            'labelOptions' => [
                'class' => 'form-control-label',
            ],
        ];

        $layout = $instanceConfig['form']->layout;

        if ($layout === 'horizontal') {
            $config['template'] = "{label}\n{beginWrapper}\n{input}\n{error}\n{hint}\n{endWrapper}";
            $cssClasses = [
                'offset' => 'offset-sm-3',
                'label' => 'col-sm-3 col-form-label',
                'wrapper' => 'col-sm-9',
                'error' => '',
                'hint' => '',
            ];
            if (isset($instanceConfig['horizontalCssClasses'])) {
                $cssClasses = ArrayHelper::merge($cssClasses, $instanceConfig['horizontalCssClasses']);
            }
            $config['horizontalCssClasses'] = $cssClasses;
            $config['options'] = ['class' => 'form-group row'];
            $config['wrapperOptions'] = ['class' => $cssClasses['wrapper']];
            Html::addCssClass($config['labelOptions'], $cssClasses['label']);
            Html::addCssClass($config['errorOptions'], $cssClasses['error']);
            Html::addCssClass($config['hintOptions'], $cssClasses['hint']);
        } elseif ($layout === 'inline') {
            $cssClasses = [
                'input' => 'mr-sm-2',
                'checkLabel' => 'mr-sm-2',
                'wrapper' => '',
                'hint' => 'mr-sm-2',
            ];
            if (isset($instanceConfig['inlineCssClasses'])) {
                $cssClasses = ArrayHelper::merge($cssClasses, $instanceConfig['inlineCssClasses']);
            }
            // If the form layout is 'inline', then set [[inline]] defaults to `true`.
            $this->inline = true;
            $config['inlineCssClasses'] = $cssClasses;
            $config['enableError'] = false;
            $config['labelOptions'] = ['class' => 'sr-only'];
            $config['wrapperOptions'] = ['class' => $cssClasses['wrapper']];
            Html::addCssClass($config['inputOptions'], $cssClasses['input']);
            Html::addCssClass($config['hintOptions'], $cssClasses['hint']);
            Html::removeCssClass($config['hintOptions'], 'form-text');
        }

        return $config;
    }
}
