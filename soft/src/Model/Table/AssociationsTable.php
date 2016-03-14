<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AssociationsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
         $this->belongsTo('Headquarters');
    
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('acronym')
            ->requirePresence('name')
            ->notEmpty('location')
            ->notEmpty('headquarters');

        return $validator;
    }
}