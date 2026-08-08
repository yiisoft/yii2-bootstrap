<?php

namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Button;
use yii\bootstrap\ButtonGroup;

/**
 * @group bootstrap
 */
class ButtonGroupTest extends TestCase
{
    public function testContainerOptions(): void
    {
        ButtonGroup::$counter = 0;
        $out = ButtonGroup::widget([
            'buttons' => [
                ['label' => 'button-A'],
                ['label' => 'button-B', 'visible' => true],
                ['label' => 'button-C', 'visible' => false],
                Button::widget(['label' => 'button-D']),
            ],
        ]);

        static::assertStringContainsString('button-A', $out);
        static::assertStringContainsString('button-B', $out);
        static::assertStringContainsString('button-B', $out);
        static::assertStringNotContainsString('button-C', $out);
    }
}
