<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 18/10/14
 * Time: 11:47 PM
 */

class Stock extends AppModel {
    public $belongsTo = 'Product';
    public $validate = array(
			'product_id' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        )
    );
}

?>