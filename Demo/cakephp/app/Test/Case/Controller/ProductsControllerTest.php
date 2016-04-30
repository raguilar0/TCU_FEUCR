<?php 
class ProductsControllerTest extends ControllerTestCase {
    public $fixtures = array('app.product');

    public function testIndex() {
        $result = $this->testAction('/products/index');
        debug($result);
    }
	public function testAdd() {
        $result = $this->testAction('/products/add');
        debug($result);
    }
	public function testSearch() {
        $result = $this->testAction('/products/search');
        debug($result);
    }
}
?>