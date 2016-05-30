<?php

class Creditcard extends AppModel{
    public $belongsTo = 'Check';
    public $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'card_users',
                'foreignKey' => 'card_id',
                'associationForeignKey' => 'user_id',
                'unique' => true
            )
    );
    public $validate = array(
        'id' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'card_number' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'nip' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'csc' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'expiration_date' => array(
            'rule' => 'notEmpty'
        ),
        'brand' => array(
            'rule' => 'notEmpty',
        ),
        'card_limit' => array(
            'rule' => 'notEmpty',
        )
    );
}
?>