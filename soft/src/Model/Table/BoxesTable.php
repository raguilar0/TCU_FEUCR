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
            ->notEmpty('little_amount')
            ->add('little_amount', 'validFormat', [
                        'rule' => array('custom', '/[0-9]+$/'),
                        'message' => 'Solo números.'
            ])
            ->notEmpty('big_amount')
            ->add('big_amount', 'validFormat', [
                        'rule' => array('custom', '/[0-9]+$/'),
                        'message' => 'Solo números.'
            ]);



        return $validator;
    }



}
