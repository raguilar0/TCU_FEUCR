<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class InvoicesTable extends Table
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
                      'rule' => array('custom', '/[0-9]+$/'),
                      'message' => 'Formato inválido. Solo números.'
          ])
          ->notEmpty('amount')
          ->add('amount', 'validFormat', [
                      'rule' => array('custom', '/^[0-9]+$/'),
                      'message' => 'Formato inválido. Solo números.'
          ])
          ->add('clarifications', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-z0-9\.\,\-\:]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('detail')
          ->add('detail', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-z0-9" "\,\.\-\:]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('kind')
          ->add('kind', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-z0-9]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('attendant')
          ->add('attendant', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-z]+$/'),
                      'message' => 'Formato inválido'
          ])
          ->notEmpty('provider')
          ->add('provider', 'validFormat', [
                      'rule' => array('custom', '/^[A-Za-z]+$/'),
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



}
