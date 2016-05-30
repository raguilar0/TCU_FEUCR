<?php

class ShippingAddress extends AppModel
{
    public $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'saddress_users',
                'foreignKey' => 'address_id',
                'associationForeignKey' => 'user_id',
                'unique' => true
            )
    );

    public $validate = array(
        'id' => array(
            'rule1' => array('rule' => array('notEmpty')),
            'rule2' => array('rule' => array('isUnique'))
        ),
        'country' => array(
            'rule' => 'notEmpty',
        ),
        'address' => array(
            'rule' => 'notEmpty',
        )
    );
}
?>