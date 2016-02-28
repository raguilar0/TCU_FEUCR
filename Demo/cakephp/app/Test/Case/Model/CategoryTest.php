<?php 
App::uses('Category', 'Model');

class CategoryTest extends CakeTestCase {
    public $fixtures = array('app.category');
	public $autoFixtures = false;
	
	public function setUp() {
        parent::setUp();
        $this->Category = ClassRegistry::init('Category');
    }
	
	public function testBringOneRegister() {
		$this->loadFixtures('Category');
		$result = $this->Category->bringOneRegister(1);
        $expected = array(
            array('categories' => array('id' => 1, 'name' => 'AVENTURA', 'parent_id' => NULL, 'lft' => 1, 'rght' => 2))
        );
        $this->assertEquals($expected, $result);
    }
	
	public function testBringAllRegisters() {
		$this->loadFixtures('Category');
		$result = $this->Category->bringAllRegisters();
        $expected = array(
            array('categories' => array('id' => 1, 'name' => 'AVENTURA', 'parent_id' => NULL, 'lft' => 1, 'rght' => 2)),
       );
        $this->assertEquals($expected, $result);
    }
	
	/*public function testBringParent()
    {
		$this->loadFixtures('Category');
		$result = $this->Category->bringParent(2);
		$expected = array(
            array('categories' => array('parent_id' => 1))
		);
		$this->assertEquals($expected, $result);
	}*/

    public function testRemoveRegister()
    {
        $this->loadFixtures('Category');
        $result = $this->Category->removeRegister();
        $expected = array();
        $this->assertEquals($expected, $result);
    }

    public function testEditRegister()
    {
        $this->loadFixtures('Category');
        $result = $this->Category->editRegister()['Category']['name'];
        $expected = 'GUERRA';
        $this->assertEquals($expected, $result);
    }
}
?>