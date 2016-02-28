<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 26/10/14
 * Time: 11:34 AM
 */
class ProductWishlist extends AppModel{
    //no era necesario el modelo, sin embargo, tuve que hacerlo para poder validar que no me repitan tuplas en la tabla
    //de link entre wishlist y producto
	
	
    public $hasToMany = array('Product');
	
    var $validate = array(
        'wishlist_id' => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada'),
        'product_id'  => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada')
    );
    function uniqueCombi() {
        $combi = array(
            "{$this->alias}.wishlist_id" => $this->data[$this->alias]['wishlist_id'],
            "{$this->alias}.product_id"  => $this->data[$this->alias]['product_id']
        );
        return $this->isUnique($combi, false);
    }
	
	 public function bringAllRegisters() {
        return $this->find('all');
    }


    public function removeRegister() {
        $this->delete(1);
        return $this->bringAllRegisters();
    }
}