<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 18/10/14
 * Time: 11:47 PM
 */

class Platform extends AppModel {
    public $hasMany = 'Product';
    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique',
            'message' => 'Ya existe esta plataforma en la lista.'
        )
    );
}

?>