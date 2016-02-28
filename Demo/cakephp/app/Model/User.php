<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
	 public $hasOne = 'Wishlist'; //un ususario tiene una wishlist que le pertenece
	 public $hasAndBelongsToMany = array(
        'Debitcard' =>
            array(
                'className' => 'Debitcard',
                'joinTable' => 'card_users',
                'foreignKey' => 'user_id',
                'associationForeignKey' => 'card_id',
                'unique' => true
            )
     );
    public $validate = array
    (
        'username' => array
        (
			'rule1' => array
            (
				'rule' => array('notEmpty')			
			),
			'rule2' => array
            (
				'rule' => array('isUnique'),
				'message' => 'The username is already used'
			),
            'rule3' => array
            (
                'rule' => array('between', 6, 100),
                'message' => 'Minimum 6 characters long'
            ),
            'noSpecial' => array(
                'rule'    => array('noSpecial'),
                'message' => 'Username can only be letters, numbers and underscores'
            )
        ),
		'password' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty')
            ),
            'rule2' => array
            (
                'rule' => array('between', 8, 100),
                'message' => 'Minimum 8 characters long'
            )
		),
        'password_confirm' => array
        (
            'required' => array
            (
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
            'equals' => array
            (
                'rule' => array('equals','password'),
                'message' => 'Both passwords must match.'
            )
        ),
		'name' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty')
            ),
            'rule2' => array
            (
                'rule' => array('between', 2, 100),
                'message' => 'Minimum 2 characters long'
            )
	    ),
	    'lastname' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty')
            ),
            'rule2' => array
            (
                'rule' => array('between', 2, 100),
                'message' => 'Minimum 2 characters long'
            )
		),
        'email' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty')
            ),
            'rule2' => array
            (
                'rule' => 'email',
                'message' => 'Invalid email'
            ),
            'rule3' => array
            (
                'rule' => array('isUnique'),
                'message' => 'The email is already used'
            )
        ),
		'country' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty')
            ),
		),
		'role' => array
        (
			'rule' => array('inList', array('admin', 'cust')),
			'message' => 'Please enter a valid role',
			'allowEmpty' => false
		),
        'password_update' => array
        (
            'rule2' => array
			(
				'rule' => array('between', 8, 100),
				'message' => 'Minimum 8 characters long',
				'allowEmpty' => true,
				'required' => false
            )
        ),
        'password_confirm_update' => array
        (
            'equaltofield' => array
            (
                'rule' => array('equaltofield','password_update'),
                'message' => 'Both passwords must match.',
                'required' => false,
            )
        )
    );

    public function noSpecial($check)
    {
        $value = array_values($check);
        $value = $value[0];
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    public function equals($check,$otherfield)
    {
        $fname = '';
        foreach ($check as $key => $value)
        {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

    public function beforeSave($options = array())
    {
        if (isset($this->data[$this->alias]['password']))
        {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}