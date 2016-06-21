<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AssociationsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Headquarters');
        $this->hasMany('Amounts');
        $this->hasMany('Boxes');
        $this->hasMany('Invoices');
        $this->hasMany('InitialAmounts');
        $this->hasMany('Surpluses');

    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('acronym')
            ->add('acronym', 'validFormat', [
                            'rule' => array('custom', '/^[A-Za-z0-9\-]+$/'),
                            'message' => 'Números o letras'
            ])
            ->notEmpty('name')
            ->add('name', 'validFormat', [
                        'rule' => array('custom', '/[A-Za-z0-9]([A-Za-z0-9]| )+/'),
                        'message' => 'Solo letras y números.'
            ])
            ->notEmpty('location')
            ->add('location', 'validFormat', [
                        'rule' => array('custom', '/[A-Za-z0-9\.\-\#\,]+$/'),
                        'message' => 'Solo letras y números.'
            ])
            ->notEmpty('headquarters')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->add('acronym', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'
            ])
            ->notEmpty('schedule')
            ->add('schedule', 'validFormat', [
                        'rule' => array('custom', '/[A-Za-z0-9\:\-]+$/'),
                        'message' => 'Solo letras y números.'
            ]);



        return $validator;
    }



}
