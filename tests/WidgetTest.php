<?php

namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Widget;

/**
 * @group bootstrap
 */
class WidgetTest extends TestCase
{
    /**
     * Invokes the [[Widget]] method even if it is protected.
     * @param  string $methodName name of the method to be invoked.
     * @param  array  $args       method arguments.
     * @return mixed  method invoke result.
     */
    protected function invokeWidgetMethod($methodName, array $args = [])
    {
        $widget = new Widget();
        $controllerClassReflection = new \ReflectionClass(get_class($widget));
        $methodReflection = $controllerClassReflection->getMethod($methodName);
        $methodReflection->setAccessible(true);
        $result = $methodReflection->invokeArgs($widget, $args);
        $methodReflection->setAccessible(false);

        return $result;
    }

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
        $this->assertEquals($expectedHtml, $this->invokeWidgetMethod('icon', [$icon]));
    }
    /**
     * Data provider for [[testLabel()]]
     * @return array test data
     */
    public function dataProviderLabel()
    {
        return [
            [
                [
                    'icon' => 'star',
                    'label' => 'test label',
                ],
                '<span class="glyphicon glyphicon-star"></span> test label',
            ],
            [
                [
                    'icon' => 'star',
                    'label' => '<html-encoded>',
                    'encode' => true,
                ],
                '<span class="glyphicon glyphicon-star"></span> &lt;html-encoded&gt;',
            ],
            [
                [
                    'icon' => 'star',
                    'label' => '<not-html-encoded>',
                    'encode' => false,
                ],
                '<span class="glyphicon glyphicon-star"></span> <not-html-encoded>',
            ],
        ];
    }
    /**
     * @dataProvider dataProviderLabel
     * @depends testIcon
     *
     * @param array $labelParams
     * @param string $expectedHtml
     */
    public function testLabel($labelParams, $expectedHtml)
    {
        $this->assertEquals($expectedHtml, $this->invokeWidgetMethod('label', [$labelParams]));
    }
} 