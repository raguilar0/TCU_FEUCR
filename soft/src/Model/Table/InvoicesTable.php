<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Event\Event;
use ArrayObject;

class InvoicesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Associations');

    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('number')
            ->add('number', 'validFormat', [
                        'rule' => array('custom', '/[A-Za-z0-9]+$/'),
                        'message' => 'Formato inválido. Solo números.'
            ])
            ->requirePresence('amount')
            ->add('amount', 'validFormat', [
                        'rule' => array('custom', '/^[0-9]+$/'),
                        'message' => 'Formato inválido. Solo números.'
            ])
            ->requirePresence('clarifications')
            ->add('clarifications', 'validFormat', [
                        'rule' => array('custom', '/^[A-Za-z0-9\.\,\-\:]+$/'),
                        'message' => 'Formato inválido'
            ])
            ->requirePresence('detail')
            ->add('detail', 'validFormat', [
                        'rule' => array('custom', '/^[A-Za-z0-9\.\,\-\:]+$/'),
                        'message' => 'Formato inválido'
            ])
            ->requirePresence('kind')
            ->add('kind', 'validFormat', [
                        'rule' => array('custom', '/^[A-Za-z0-9]+$/'),
                        'message' => 'Formato inválido'
            ])
            ->requirePresence('attendant')
            ->add('attendant', 'validFormat', [
                        'rule' => array('custom', '/^[A-Za-z]+$/'),
                        'message' => 'Formato inválido'
            ])
            ->requirePresence('provider')
            ->add('provider', 'validFormat', [
                        'rule' => array('custom', '/^[A-Za-z]+$/'),
                        'message' => 'Formato inválido'
            ])
            ->requirePresence('legal_certificate')
            ->add('legal_certificate', 'validFormat', [
                        'rule' => array('custom', '/[0-9\-]+$/'),
                        'message' => 'Formato inválido.'
            ])

            ;


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
