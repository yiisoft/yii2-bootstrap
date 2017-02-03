<?php

namespace yiiunit\extensions\bootstrap;

use yii\base\DynamicModel;
use yii\bootstrap\ActiveField;
use yii\bootstrap\ActiveForm;
use Yii;

class ExtendedActiveFieldTest extends TestCase
{
    /**
     * @var ActiveField
     */
    private $activeField;
    /**
     * @var DynamicModel
     */
    private $helperModel;
    /**
     * @var ActiveForm
     */
    private $helperForm;
    /**
     * @var string
     */
    private $attributeName = 'attributeName';

    protected function setUp()
    {
        // dirty way to have Request object not throwing exception when running testHomeLinkNull()
        $_SERVER['SCRIPT_FILENAME'] = "index.php";
        $_SERVER['SCRIPT_NAME'] = "index.php";

        parent::setUp();

        $this->helperModel = new DynamicModel(['attributeName']);
        ob_start();
        $this->helperForm = new ActiveForm([
            'action' => '/something',
            'layout' => 'horizontal',
        ]);
        ob_end_clean();

        $this->activeField = new ActiveField(['form' => $this->helperForm]);
        $this->activeField->model = $this->helperModel;
        $this->activeField->attribute = $this->attributeName;
    }

    public function testHorizontalCssClasses()
    {
        $html = $this->activeField->render();
        $expectedHtml = <<<EXPECTED
<div class="form-group field-dynamicmodel-attributename">
<label class="control-label col-sm-3" for="dynamicmodel-attributename">Attribute Name</label>
<div class="col-sm-6">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">
<div class="help-block help-block-error "></div>
</div>

</div>
EXPECTED;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
