<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BoxesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');

        $this->belongsTo('Associations');

    }


    public function validationDefault(Validator $validator)
    {

      $validator

          ->requirePresence('id')
          ->add('id', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/')
          ])
          ->requirePresence('little_amount')
          ->add('little_amount', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/')
          ])
          ->requirePresence('big_amount')
          ->add('big_amount', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/')
          ])
          ->requirePresence('little_amount')
          ->add('little_amount', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/')
          ])
          ->requirePresence('type')
          ->add('type', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/')
          ])
          ->requirePresence('association_id')
          ->add('association_id', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/')
          ])
          ->requirePresence('tract_id')
          ->add('tract_id', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/')
          ]);


      return $validator;
    }
}
