<?php
namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\ButtonDropdown;

/**
 * @group bootstrap
 */
class ButtonDropdownTest extends TestCase
{
    public function testContainerOptions()
    {
        $containerClass = "dropup";

        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'containerOptions' => [
                'class' => $containerClass,
            ],
            'label' => 'Action',
            'dropdown' => [
                'items' => [
                    ['label' => 'DropdownA', 'url' => '/'],
                    ['label' => 'DropdownB', 'url' => '#'],
                ],
            ],
        ]);

        $this->assertStringContainsString("$containerClass btn-group", $out);
    }
}
