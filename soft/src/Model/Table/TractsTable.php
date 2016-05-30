<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\I18n\Time;
use Cake\Event\Event;
use ArrayObject;

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
	

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
       if (isset($data['date'])) {
           $data['date'] = new Time($data['date']);
       }

       if (isset($data['deadline'])) {
           $data['deadline'] = new Time($data['deadline']);
       }

    }

}