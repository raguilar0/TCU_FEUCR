<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 27/10/14
 * Time: 11:41 PM
 */

class Country extends AppModel {
    public $validate = array(
        'country_name' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique',
            'message' => 'Ya existe este país en la lista.'
        )
    );
}

?>