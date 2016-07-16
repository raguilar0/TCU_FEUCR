<?php
namespace App\Model\Table;

use App\Model\Entity\Box;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Boxes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Associations
 * @property \Cake\ORM\Association\BelongsTo $Tracts
 */
class BoxesTable extends Table
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

        $this->table('boxes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Associations', [
            'foreignKey' => 'association_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tracts', [
            'foreignKey' => 'tract_id',
            'joinType' => 'INNER'
        ]);
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
            ->allowEmpty('id', 'create')
            ->requirePresence('tract_id', 'create');

        $validator
            ->numeric('little_amount')
            ->requirePresence('little_amount', 'create')
            ->notEmpty('little_amount')
            ->add('little_amount', 'validFormat', [
                        'rule' => array('custom', '/^[0-9\,\.]+$/'),
                        'message' => 'Formato inválido. Solo números.'
            ]);

        $validator
            ->numeric('big_amount')
            ->requirePresence('big_amount', 'create')
            ->notEmpty('big_amount')
            ->add('big_amount', 'validFormat', [
                        'rule' => array('custom', '/^[0-9\,\.]+$/'),
                        'message' => 'Formato inválido. Solo números.'
            ]);

        $validator
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

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
        $rules->add($rules->existsIn(['association_id'], 'Associations'));
        $rules->add($rules->existsIn(['tract_id'], 'Tracts'));
        return $rules;
    }

    public function isOwnedBy($boxId, $association_id)
    {

        return $this->exists(['id' => $accountId, 'association_id' => $association_id]);
    }
}
