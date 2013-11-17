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
 * Panel renders a Panel block.
 *
 * For example
 *
 *```php
 *
 * echo Panel::widget([
 *       'header' => Html::a('Some link', ['url']),
 *       'body' => 'only clean text no HTML tags',
 *       'footer' => Html::a('HTML lin', ['url']) . 'and clean text..',
 *       'headerOptions' => ['id'=>'PanelHeader'],
 *       'bodyOptions' => ['id'=>'PanelBody'],
 *       'footerOptions' => ['id'=>'PanelFooter'],
 * ]);
 * 
 * ```
 *
 * @see http://getbootstrap.com/components/#panels
 * @author Svetoslav Mutev <sfetliooo@gmail.com>
 * @since 2.0
 */
class Panel extends Widget
{
	/**
	 * Panel Header content
	 * @var String
	 */
	public $header;
	/**
	 * Panel Body content
	 * @var String
	 */
	public $body;
	/**
	 * Panel Footer content
	 * @var String
	 */
	public $footer;
	/**
	 * Panel Header element options!
	 * @var Array
	 */
	public $headerOptions;
	/**
	 * Panel Header element options!
	 * @var Array
	 */
	public $bodyOptions;
	/**
	 * Panel Header element options!
	 * @var Array
	 */
	public $footerOptions;
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'panel panel-default');
		Html::addCssClass($this->headerOptions, 'panel-heading');
		Html::addCssClass($this->bodyOptions, 'panel-body');
		Html::addCssClass($this->footerOptions, 'panel-footer');
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		if( $this->header){
			echo $this->renderPanelElement('header') . "\n";
		}
		if( $this->body){
			echo $this->renderPanelElement('body') . "\n";
		}
		if( $this->footer){
			echo $this->renderPanelElement('footer') . "\n";
		}
		echo Html::endTag('div') . "\n";
	}

	/**
	 * Renders panel elements.
	 * @return string the rendering result
	 */
	public function renderPanelElement( $element = FALSE)
	{
		if( !$element || !isset($this->{$element})){
			return '';
		}
		$options = "{$element}Options";
		$html = Html::beginTag('div', $this->{$options}) . "\n";
		$html .= $this->{$element} . "\n";
		$html .= Html::endTag('div') . "\n";
		return $html;
	}
}
