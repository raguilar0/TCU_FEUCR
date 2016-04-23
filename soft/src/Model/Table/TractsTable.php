<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

class TractsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        
    }


	public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('number')
            ->add('number', 'validFormat', [
                            'rule' => array('custom', '/^[1-4]$/'),
                            'message' => 'Solo números entre [1-4]'
            ]);


        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['date','deadline']));

        return $rules;
    }
	
	
}