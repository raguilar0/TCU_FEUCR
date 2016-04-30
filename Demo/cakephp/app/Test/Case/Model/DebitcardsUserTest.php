<?php
App::uses('DebitcardsUser', 'Model');

class DebitcardsUserTest extends CakeTestCase {
    public $fixtures = array('app.debitcardsuser',);
    //public $autoFixtures = false;

    public function setUp() {
        parent::setUp();
        $this->DebitcardsUser = ClassRegistry::init('DebitcardsUser');
    }

    public function testBringAllRegisters() {
        $result = $this->DebitcardsUser->bringAllRegisters();
        $expected = array(
            array('DebitcardsUser' =>   array(
                'id' => 1,
                'user_id' => 1,
                'debitcard_id' =>1
            )
            ),
        );
        $this->assertEquals($expected, $result);
    }


    public function testRemoveRegister() {
        $result = $this->DebitcardsUser->removeRegister();
        $expected = array();
        $this->assertEquals($expected, $result);
    }
}
?>