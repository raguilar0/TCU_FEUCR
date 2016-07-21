<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Event\Event;
use ArrayObject;
use Cake\Datasource\ConnectionManager;
class AmountsTable extends Table
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
            ->requirePresence('amount')
            ->notEmpty('amount')
            ->add('amount', 'validFormat', [
                                    'rule' => array('custom', '/^[0-9,.\-]+$/'),
                                    'message' => 'Debe ser mayormente para números.'
            ])
            ->requirePresence('tract_id','create')
            ->notEmpty('date')
            ->notEmpty('deadline')
            ->notEmpty('detail', 'Ingrese el detalle del monto')
            ->add('detail', 'validFormat', [
                                    'rule' => array('custom',  '/^[A-Za-záéíóúÁÉÍÓÚñÑ0-9" "\,\.\-\:\[\]\(\)\"]+$/'),
                                    'message' => 'Debe contener solamente letras.'
            ])
            ->add('detail', [
                        'lengthBetween' => ['rule' => ['lengthBetween', 1, 8192],
                                        'message' => 'Debe contener mínimo 1 y máximo 8192 caracteres.',
                        ]
            ]);
        return $validator;
    }
    public function validationUpdate(Validator $validator)
    {
        $validator
            ->requirePresence('amount')
            ->notEmpty('amount')
            ->add('amount', 'validFormat', [
                'rule' => array('custom', '/^[0-9,.\-]+$/'),
                'message' => 'Debe ser mayormente para números.'
            ]);

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
    public function getConnection()
    {
       // $dsn = 'mysql://sql3114688:9KUJFT3TWD@sql3.freemysqlhosting.net/sql3114688';
        //ConnectionManager::config('event', ['url' => $dsn]);
        $connection = ConnectionManager::get('default');
        return $connection;
    }

    public function isOwnedBy($amountId, $association_id)
    {
        return $this->exists(['id' => $amountId, 'association_id' => $association_id, 'type'=>1]);
    }
}
