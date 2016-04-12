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
        $this->belongsTo('Associations');
    
    }

    public function validationDefault(Validator $validator)
    {
        $validator      
            ->requirePresence('number')
            ->requirePresence('amount')
            ->requirePresence('clarifications')
            ->requirePresence('detail')
            ->requirePresence('kind')
            ->requirePresence('attendant');


        return $validator;
    }
	
	
	
}