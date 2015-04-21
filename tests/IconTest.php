<?php

namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Icon;

/**
 * @group bootstrap
 */
class IconTest extends TestCase
{
    /**
     * Data provider for [[testIcon()]]
     * @return array test data
     */
    public function dataProviderIcon()
    {
        return [
            [
                'star',
                '<span class="glyphicon glyphicon-star"></span>',
            ],
            [
                '<i class="my-icon"></i>',
                '<i class="my-icon"></i>',
            ],
            [
                [
                    'tag' => 'i',
                    'class' => 'my-icon',
                ],
                '<i class="my-icon"></i>',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderIcon
     */
    public function testIcon($icon, $expectedHtml)
    {
        $this->assertEquals($expectedHtml, Icon::icon($icon));
    }

    /**
     * Data provider for [[testLabel()]]
     * @return array test data
     */
    public function dataProviderLabel()
    {
        return [
            [
                'star',
                'test label',
                [],
                '<span class="glyphicon glyphicon-star"></span> test label',
            ],
            [
                'star',
                '<html-encoded>',
                [],
                '<span class="glyphicon glyphicon-star"></span> &lt;html-encoded&gt;',
            ],
            [
                'star',
                '<not-html-encoded>',
                [
                    'encode' => false
                ],
                '<span class="glyphicon glyphicon-star"></span> <not-html-encoded>',
            ],
            [
                'star',
                'reverse-template',
                [
                    'template' => '{label} {icon}'
                ],
                'reverse-template <span class="glyphicon glyphicon-star"></span>',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderLabel
     * @depends testIcon
     *
     * @param string|array $icon
     * @param string $label
     * @param array $options
     * @param string $expectedHtml
     */
    public function testLabel($icon, $label, $options, $expectedHtml)
    {
        $this->assertEquals($expectedHtml, Icon::label($icon, $label, $options));
    }
} 