<?php

namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Html;

/**
 * @group bootstrap
 */
class HtmlTest extends TestCase
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
                [],
                '<span class="glyphicon glyphicon-star"></span>',
            ],
            [
                'star',
                [
                    'tag' => 'i',
                    'prefix' => 'my-icon icon-',
                ],
                '<i class="my-icon icon-star"></i>',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderIcon
     *
     * @param $name
     * @param $options
     * @param $expectedHtml
     */
    public function testIcon($name, array $options, $expectedHtml)
    {
        $this->assertEquals($expectedHtml, Html::icon($name, $options));
    }

    /**
     * @return array
     */
    public function dataProviderStaticControl()
    {
        return [
            [
                'foo',
                [],
                '<p class="form-control-static">foo</p>'
            ],
            [
                '<html>',
                [],
                '<p class="form-control-static">&lt;html&gt;</p>'
            ],
            [
                '<html></html>',
                [
                    'encode' => false
                ],
                '<p class="form-control-static"><html></html></p>'
            ],
        ];
    }

    /**
     * @dataProvider dataProviderStaticControl
     *
     * @param string $value
     * @param array $options
     * @param string $expectedHtml
     */
    public function testStaticControl($value, array $options, $expectedHtml)
    {
        $this->assertEquals($expectedHtml, Html::staticControl($value, $options));
    }
    
    /**
     * @return array
     */
    public function dataProviderGridCol() {
        return [
            [
                [1,2,3,4],
                [],
                '<div class="col-xs-1 col-sm-2 col-md-3 col-lg-4">'
            ],
            [
                [1,2],
                [
                    "class" => "row",
                ],
                '<div class="row col-xs-1 col-sm-2">'
            ],
            [
                [
                    "xs" => 12,
                    "lg" => 6,
                ],
                [],
                '<div class="col-xs-12 col-lg-6">'
            ],
        ];
    }
    
    /**
     * @dataProvider dataProviderGridCol
     * 
     * @param array $value
     * @param array $options
     * @param string $expectedHtml
     */
    public function testGridCol(array $value, array $options, $expectedHtml) {
        $this->assertEquals($expectedHtml, Html::beginGridCol($value, $options));
    }
    
    /**
     * @return array
     */
    public function dataProviderGridRow() {
        return [
            [
                [],
                '<div class="row">'
            ],
            [
                [
                    "class" => "form-control",
                ],
                '<div class="form-control row">'
            ],
        ];
    }
    
    /**
     * @dataProvider dataProviderGridRow
     * 
     * @param array $options
     * @param string $expectedHtml
     */
    public function testGridRow(array $options, $expectedHtml) {
        $this->assertEquals($expectedHtml, Html::beginGridRow($options));
    }
} 