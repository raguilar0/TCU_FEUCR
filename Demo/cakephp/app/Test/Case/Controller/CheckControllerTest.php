<?php
/**
 * Created by PhpStorm.
 * User: MariaJose
 * Date: 13/11/2014
 * Time: 09:18 PM
 */
class CheckControllerTest extends ControllerTestCase
{
    public $fixtures = array('app.check','app.checkproduct','app.carduser','app.debitcard','app.product');

    public function testCheck() {
        $result = $this->testAction('checks/check');
        debug($result);
    }
	
	public function testView(){
		$result = $this->testAction('checks/view/1');
		debug($result);
	}


}
?>