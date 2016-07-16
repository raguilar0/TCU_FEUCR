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
        $this->belongsTo('Tracts', [
            'foreignKey' => 'tract_id',
            'joinType' => 'INNER'
        ]);

    }

    public function validationDefault(Validator $validator)
    {

      $validator
          ->requirePresence('tract_id','create')
          ->notEmpty('number')
          ->add('number', 'validFormat', [
                      'rule' => array('custom', '/[0-9]+$/'),
                      'message' => 'Formato inválido. Solo números.'
          ])
          ->notEmpty('amount')
          ->add('amount', 'validFormat', [
                      'rule' => array('custom', '/^[0-9\,\.]+$/'),
                      'message' => 'Formato inválido. Solo números.'
          ])
          ->add('clarifications', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-z0-9" "\,\.\-\:áéíóú]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('detail')
          ->add('detail', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-záéíóú0-9" "\,\.\-\:]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('kind')
          ->add('kind', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-záéíóú0-9" "]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('attendant')
          ->add('attendant', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-záéíóú0-9" "]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('provider')
          ->add('provider', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-záéíóú0-9" "\,\.\-\:]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('legal_certificate')
          ->add('legal_certificate', 'validFormat', [
                      'rule' => array('custom', '/^[0-9\-]+$/'),
                      'message' => 'Formato inválido'
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


    public function isOwnedBy($accountId, $association_id)
    {

        return $this->exists(['id' => $accountId, 'association_id' => $association_id]);
    }

}
