<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class HeadquartersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    
    }

	
	public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->add('name', 'validFormat', [
                            'rule' => array('custom', '/^[A-Za-z0-9\-]+$/'),
                            'message' => 'Números o letras'
            ])
            ->add('image_name', 'validFormat', [
                            'rule' => array('custom', '/^[A-Za-z0-9.\-]+$/'),
                            'message' => 'Números o letras'
            ]);

        return $validator;
    }
	
}