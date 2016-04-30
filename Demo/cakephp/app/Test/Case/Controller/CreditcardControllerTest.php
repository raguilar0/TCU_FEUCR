<?php
class CreditcardControllerTest extends ControllerTestCase
{
    public $fixtures = array('app.creditcard');

    public function testAdd()
    {
        $result = $this->testAction('/creditcard/add');
        debug($result);
    }
}
?>