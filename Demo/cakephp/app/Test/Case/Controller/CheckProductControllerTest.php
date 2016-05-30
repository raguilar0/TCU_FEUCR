<?php
/**
 * Created by PhpStorm.
 * User: MariaJose
 * Date: 13/11/2014
 * Time: 09:18 PM
 */
class CheckProductControllerTest extends ControllerTestCase
{
    public $fixtures = array('app.checkproduct','app.product','app.check','app.carduser');

    public function testSales() {
        $result = $this->testAction('checkproduct/sales');
        debug($result);
    }

}
?>