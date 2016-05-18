<?php 
class ProductWishlistControllerTest extends ControllerTestCase {
     public $fixtures = array('app.productwishlist','app.wishlist');

    public function testIndex() {
        $result = $this->testAction('/productwishlist/index');
        debug($result);
    }
	public function testAdd() {
        $result = $this->testAction('/productwishlist/add');

        debug($result);
    }
	
	public function testDelete(){
        $result = $this->testAction('/productwishlist/delete');
        debug($result);
    }
}
?>