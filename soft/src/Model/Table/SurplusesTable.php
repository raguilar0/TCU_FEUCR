<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Event\Event;
use ArrayObject;

class SurplusesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Associations');      
    
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('amount')
            ->notEmpty('amount')
            ->add('amount', 'validFormat', [
                                    'rule' => array('custom', '/^[0-9,.\-]+$/'),
                                    'message' => 'Solo se permiten números.'
            ])
            ->notEmpty('date')
            ->notEmpty('detail', 'Ingrese el detalle del monto')
            ->add('detail', 'validFormat', [
                                    'rule' => array('custom', '/[a-zA-Z0-9$.%@\-]+$/'),
                                    'message' => 'Debe contener solamente letras y números.'
            ])
            ->add('detail', [
                        'lengthBetween' => ['rule' => ['lengthBetween', 1, 8192],
                                        'message' => 'Debe contener mínimo 1 y máximo 8192 caracteres.',
                        ]
            ]);

        return $validator;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
       if (isset($data['date'])) {
           $data['date'] = new Time($data['date']);
       }

    }
	
	
	
}