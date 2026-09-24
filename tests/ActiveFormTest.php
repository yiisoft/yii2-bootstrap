<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\ActiveForm;

/**
 * Tests for ActiveForm widget
 *
 * @group bootstrap
 */
class ActiveFormTest extends TestCase
{
    protected function setUp(): void
    {
        // dirty way to have Request object not throwing exception when running testFormNoRoleAttribute()
        $_SERVER['REQUEST_URI'] = 'index.php';

        parent::setUp();
    }

    /**
     * Fixes #196
     */
    public function testFormNoRoleAttribute(): void
    {
        $form = ActiveForm::widget();

        $this->assertStringNotContainsString('role="form"', $form);
    }
}
