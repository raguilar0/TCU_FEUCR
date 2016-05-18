<?php
App::uses('AppModel', 'Model');

class BillingAddress extends AppModel
{
    public $hasAndBelongsToMany = array
    (
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'baddress_users',
                'foreignKey' => 'address_id',
                'associationForeignKey' => 'user_id',
                'unique' => true
            )
    );

    public $validate = array
    (
        'adress' => array
        (
			'rule1' => array
            (
				'rule' => array('notEmpty')			
			),
            'rule2' => array
            (
                'rule' => array('between', 20, 100),
                'message' => 'Minimum 20 characters long'
            ),
            'noSpecial' => array(
                'rule'    => array('noSpecial'),
                'message' => 'Username can only be letters, numbers and underscores'
            )
        ),
		'country' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty')
            ),
		)
    );

    public function noSpecial($check)
    {
        $value = array_values($check);
        $value = $value[0];
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
}