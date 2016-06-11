<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Event\Event;
use ArrayObject;


class SavingsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Associations');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('amount')
            ->add('amount', 'validFormat', [
                            'rule' => array('custom', '/^[0-9]+$/'),
                            'message' => 'Solo numeros'
            ])
            ->requirePresence('amount')

            ->notEmpty('letter')
            ->add('letter', 'validFormat', [
                        'rule' => array('custom', '/[A-Za-z0-9]+$/'),
                        'message' => 'Solo letras y números.'
            ])
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
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