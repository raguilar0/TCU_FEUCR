<?php 
App::uses('ProductWishlist', 'Model');

class ProductWishlistTest extends CakeTestCase {
    public $fixtures = array('app.productwishlist',);
	//public $autoFixtures = false;
	
	public function setUp() {
        parent::setUp();
        $this->ProductWishlist = ClassRegistry::init('ProductWishlist');
    }

	public function testBringAllRegisters() {
		$result = $this->ProductWishlist->bringAllRegisters();
        $expected = array(
            array('ProductWishlist' =>   array(
                        'id' => 1,
                        'wishlist_id' => 1,
                        'product_id' =>1
                    )
			),
        );
        $this->assertEquals($expected, $result);
    }


	public function testRemoveRegister() {
		$result = $this->ProductWishlist->removeRegister();
        $expected = array();
        $this->assertEquals($expected, $result);
    }
}
?>