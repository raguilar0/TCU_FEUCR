<?php
class DebitcardControllerTest extends ControllerTestCase
{
    public $fixtures = array('app.debitcard');

    public function testAdd()
    {
        $result = $this->testAction('/debitcard/add');
        debug($result);
    }
}
?>