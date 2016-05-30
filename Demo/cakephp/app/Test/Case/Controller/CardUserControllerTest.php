<?php
class CardUserControllerTest extends ControllerTestCase
{
    public $fixtures = array('app.carduser','app.debitcard','app.creditcard');

    public function testDeleteDebit()
    {
        $result = $this->testAction('/carduser/delete_debit/1');
        debug($result);
    }

    public function testDeleteCredit()
    {
        $result = $this->testAction('/carduser/delete_credit/100');
        debug($result);
    }
}
?>