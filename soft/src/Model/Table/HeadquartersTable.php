<?php
namespace App\Model\Table;

use App\Model\Entity\Headquarters;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Headquarters Model
 *
 */
class HeadquartersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('headquarters');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', [
              'rule' => 'validateUnique',
              'provider' => 'table'
          ])
            ->add('name', 'validFormat', [
                        'rule' => array('custom',  '/^[A-Za-záéíóúÁÉÍÓÚñÑ0-9" "\,\.\-\:\[\]\(\)\"]+$/'),
                        'message' => 'Formato inválido'
            ]);

        $validator
            ->requirePresence('image_name', 'create')
            ->notEmpty('image_name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
}
