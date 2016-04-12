<?php
App::uses('Check', 'Model');

class CheckTest extends CakeTestCase {
    public $fixtures = array('app.check','app.debitcard','app.checkproduct','app.product');


public function setUp() {
        parent::setUp();
        $this->Check = ClassRegistry::init('Check');
    }

    public function testRemoveRegister() {
        $this->loadFixtures('Check');
        $result = $this->Check->removeRegister();
        $expected = array();
        $this->assertEquals($expected, $result);
    }
}


?>