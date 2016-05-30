<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AmountsTable extends Table
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
                                    'message' => 'Debe ser mayormente para números.'
            ])
            ->notEmpty('date')
            ->notEmpty('deadline')
            ->notEmpty('detail', 'Ingrese el detalle del monto')
            ->add('detail', 'validFormat', [
                                    'rule' => array('custom', '/^[a-zA-Z0-9$%@ \-]*$/'),
                                    'message' => 'Debe contener solamente letras.'
            ])
            ->add('detail', [
                'length' => [
                            'rule' => ['maxLength', 2048],
                            'message' => 'Debe contener máximo 2048 caracteres.',
                            ]
            ]);

        return $validator;
    }
}