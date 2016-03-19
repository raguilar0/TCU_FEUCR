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
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }
	
}