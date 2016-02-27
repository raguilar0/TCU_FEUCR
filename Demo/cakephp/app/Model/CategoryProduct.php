<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 26/10/14
 * Time: 11:34 AM
 */
class CategoryProduct extends AppModel{
    //no era necesario el modelo, sin embargo, tuve que hacerlo para poder validar que no me repitan tuplas en la tabla
    //de link entre wishlist y producto
    var $validate = array(
        'product_id' => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada'),
        'category_id'  => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada')
    );
    function uniqueCombi() {
        $combi = array(
            "{$this->alias}.product_id" => $this->data[$this->alias]['product_id'],
            "{$this->alias}.category_id"  => $this->data[$this->alias]['category_id']
        );
        return $this->isUnique($combi, false);
    }
}