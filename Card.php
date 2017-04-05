<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Card renders a card bootstrap component.
 *
 * For example,
 *
 * ```php
 * echo Card::widget([
 *   'options' => [...],
 *   'headerText' => 'Card header',
 *   'headerOptions' => [...],
 *   'topImagePath' => 'http://static.yiiframework.com/css/img/logo.png',
 *   'topImageOptions' => [...],
 *   'blocks' => [
 *      [
 *          'options' => [...],
 *          'visible' => Yii::$app->user->isGuest,
 *          'title' => 'Card title',
 *          'subtitle' => 'Card subtitle',
 *          'text' => 'This is some text within a card block.',
 *          'links' => [
 *              ['text' => 'Link1', 'url' => '#'],
 *              ['text' => 'Link2', 'url' => '#'],
 *          ],
 *      ],
 *  ],
 *  'footerText' => 'Card footer',
 *  'footerOptions' => [...],
 *  ]);
 * ```
 * @see https://v4-alpha.getbootstrap.com/components/card/
 * @author Roman Gushel <romagrd16@gmail.com>
 * @since 2.1
 */
class Card extends Widget
{
    /**
     * @var string|null text to show in header within a card.
     */
    public $headerText;
    /**
     * @var array the HTML attributes of the header container.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $headerOptions = [];
    /**
     * @var string|null text to show in footer within a card.
     */
    public $footerText;
    /**
     * @var array the HTML attributes of the footer container.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $footerOptions = [];
    /**
     * @var array|string|null $topImagePath the image URL.
     * This parameter will be processed by [[\yii\helpers\BaseHtml::img()]]
     * You may set it to `null` if you want to have no image at all.
     */
    public $topImagePath;
    /**
     * @var array the HTML attributes of the top image.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $topImageOptions = [];

    /**
     * @var array list of blocks in the card widget. Each array element represents a single
     * block item which can be either a string or an array with the following structure:
     *
     * - options: array, optional, the HTML attributes of the item container.
     * - title: string, optional, is displayed as title in card within block (H4).
     * - subtitle: string, optional, is displayed as subtitle in card within block (H6).
     * - text: string, optional, the text make up the bulk of the block's content (P).
     * - visible: boolean, optional, whether this block is visible. Defaults to true.
     * - html: string, optional, the raw html that will be rendered directly without HTML encoding,
     *  in the end of block.
     * - links: array, optional, the configuration array for creating links.  Each item can hold three extra keys:
     *  * text: string, required, the link body.
     *  * url: array|string, optional, the URL for the hyperlink tag. This parameter will be processed by [[Url::to()]].
     *  * options: array, optional, the tag options in terms of name-value pairs.
     *
     * If a block item is a string, it will be rendered directly without HTML encoding.
     */
    public $blocks = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['widget' => 'card']);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::beginTag('div', $this->options);
        if ($this->headerText !== null) {
            Html::addCssClass($this->headerOptions, 'card-header');
            echo Html::tag('div', $this->headerText, $this->headerOptions);
        }
        if ($this->topImagePath !== null) {
            Html::addCssClass($this->topImageOptions, 'card-img-top');
            echo Html::img($this->topImagePath, $this->topImageOptions);
        }
        echo $this->renderBlocks();
        if ($this->footerText !== null) {
            Html::addCssClass($this->footerOptions, 'card-footer');
            echo Html::tag('div', $this->footerText, $this->footerOptions);
        }
        echo Html::endTag('div');
    }


    /**
     * Renders blocks within card.
     */
    public function renderBlocks()
    {
        $blocks = [];
        foreach ($this->blocks as $i => $block) {
            if (isset($block['visible']) && !$block['visible']) {
                continue;
            }
            $blocks[] = $this->renderBlock($block);
        }

        return implode("\n", $blocks);
    }

    /**
     * Renders a block.
     * @param string|array $block the block to render.
     * @return string the rendering result.
     * @throws InvalidConfigException if the item is invalid.
     */
    public function renderBlock($block)
    {
        if (is_string($block)) {
            return $block;
        }

        $options = ArrayHelper::getValue($block, 'options', []);
        $title = ArrayHelper::getValue($block, 'title');
        $subtitle = ArrayHelper::getValue($block, 'subtitle');
        $text = ArrayHelper::getValue($block, 'text');
        $links = ArrayHelper::getValue($block, 'links', []);
        $html = ArrayHelper::getValue($block, 'html');

        $title = $title === null ? $title : Html::tag('h4', $title, ['class' => 'card-title']);
        $subtitle = $subtitle === null ? $subtitle : Html::tag('h6', $subtitle, ['class' => 'card-subtitle']);
        $text = $text === null ? $text : Html::tag('p', $text, ['class' => 'card-text']);

        if (empty($links) || !is_array($links)) {
            $links = '';
        } else {
            foreach ($links as &$link) {
                if (!is_array($link) || !array_key_exists('text', $link)) {
                    throw new InvalidConfigException();
                }
                $linkOptions = ArrayHelper::getValue($link, 'options', []);
                Html::addCssClass($linkOptions, 'card-link');
                $link = Html::a($link['text'], $link['url'], $linkOptions);
            }
            $links = implode("\n", $links);
        }

        Html::addCssClass($options, 'card-block');
        return Html::tag('div', $title . $subtitle . $text . $links . $html, $options);
    }
}
