<?php 
App::uses('Product', 'Model');

class ProductTest extends CakeTestCase {

		public $fixtures = array('app.product', 'app.stock');
		public $autoFixtures = false;
		public function setUp() {
			parent::setUp();
			$this->Product = ClassRegistry::init('Product');
		}
		
		public function testInsertProductStock() {
        $this->loadFixtures('Product', 'Stock');
        $result = $this->Product->getProductStock();
        /* $expected = array(
            array('categories' => array('parent_id' => 1))
        );
        */
        $expected = array(
            'Stock' => Array (
                            'id' => 1,
                            'product_id' => 1,
                            'amount' => 5
                            ),
            'Product' => Array (
                            'id' => 1,
                            'name' => 'RE4',
                            'platform_id' => 2,
                            'release_year' => '2004', //no estoy segura si va en comillas
                            'price' => 5,
                            'description' => 'a really nice game',
                            'presentation' => 1,
                            'enabled' => 1,
                            'requirement' => '',
                            'rated' => 0,
                            'discount' => 0,
                            'rating' => 0,
                            'image' => null,
                            'video' => null,
                            'outofstock' => 0,
                            'tax' => 0
             )
        );
		$this->assertEquals($expected, $result);
    }
        public function testDelProductStock() {
            $this->loadFixtures('Product', 'Stock');
            $result = $this->Product->delProductStock();
            $expected = array(
            );
        $this->assertEquals($expected, $result);
        }

    public function testEnable() {
        $this->loadFixtures('Product');
        $result = $this->Product->enable()['Product']['enabled'];
        /* $expected = array(
            array('categories' => array('parent_id' => 1))
        );
        */
        $expected = 1;
        $this->assertEquals($expected, $result);
    }

    public function testDisable() {
        $this->loadFixtures('Product');
        $result = $this->Product->disable()['Product']['enabled'];
        /* $expected = array(
            array('categories' => array('parent_id' => 1))
        );
        */
        $expected = 0;
        $this->assertEquals($expected, $result);
    }
		/*
		public $import = array('model' => 'Product'); //, 'records' => true);
		public $records = array(
			array(
						'id' => 1,
						'name' => 'RE4',
						'platform_id' => 2,
						'release_year' => '2004', //no estoy segura si va en comillas
						'price' => 5,
						'description' => 'a really nice game',
						'presentation' => 1,
						'enabled' => 1,
						'requirement' => '',
						'rated' => 0,
						'discount' => 0,
						'rating' => 0,
						'image' => null,
						'video' => null,
						'outofstock' => 0,
						'tax' => 0
			)
     );
    /*
	public $fixtures = array('app.product');
	public $autoFixtures = false;
	
	public function setUp() {
        parent::setUp();
        $this->Product = ClassRegistry::init('Product');
    }
	
	public function testBringAllRegisters() {
		$this->loadFixtures('Product');
		$result = $this->Product->bringAllRegisters();	
        $expected = array(
            array('Product' => array(
									  'id' => 1,
									  'name' => 'RE4',
									  'genre' => 'Horror',
									  'console' => 'PS3',
									  'release_year' => '2004', 
									  'price' => 5,
									  'description' => 'a really nice game',
									  'amount' => 5,
									  'image' => 'http://frikarte.com/wp-content/uploads/2013/03/Resident-Evil-4-Wii-Frikarte.jpg',
									  'video' => 'www.youtube.com/embed/PHQFgS44lMA'
									)
			),
        );
        $this->assertEquals($expected, $result);
    }
	
	public function testEditField() {
		$this->loadFixtures('Product');
		$result = $this->Product->editField();	
        $expected = array(
            array('Product' => array(
									  'id' => 1,
									  'name' => 'RE5',
									  'genre' => 'Horror',
									  'console' => 'PS3',
									  'release_year' => '2004', 
									  'price' => 5,
									  'description' => 'a really nice game',
									  'amount' => 5,
									  'image' => 'http://frikarte.com/wp-content/uploads/2013/03/Resident-Evil-4-Wii-Frikarte.jpg',
									  'video' => 'www.youtube.com/embed/PHQFgS44lMA'
									)
			),
        );
        $this->assertEquals($expected, $result);
    }
	
	public function testRemoveRegister() {
		$this->loadFixtures('Product');
		$result = $this->Product->removeRegister();	
        $expected = array();
        $this->assertEquals($expected, $result);
    }
	*/
}
?>