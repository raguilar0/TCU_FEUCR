<?php
namespace App\Model\Table;

use App\Model\Entity\Association;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Associations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Headquarters
 * @property \Cake\ORM\Association\HasMany $Amounts
 * @property \Cake\ORM\Association\HasMany $Boxes
 * @property \Cake\ORM\Association\HasMany $InitialAmounts
 * @property \Cake\ORM\Association\HasMany $Invoices
 * @property \Cake\ORM\Association\HasMany $SavingAccounts
 * @property \Cake\ORM\Association\HasMany $Savings
 * @property \Cake\ORM\Association\HasMany $Surpluses
 * @property \Cake\ORM\Association\HasMany $Users
 * @property \Cake\ORM\Association\HasMany $Warehouses
 */
class AssociationsTable extends Table
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

        $this->table('associations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Headquarters', [
            'foreignKey' => 'headquarter_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tracts', [
            'foreignKey' => 'tract_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Amounts', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Boxes', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('InitialAmounts', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('SavingAccounts', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Savings', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Surpluses', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Warehouses', [
            'foreignKey' => 'association_id'
        ]);

        $this->belongsTo('Tracts', [
            'foreignKey' => 'tract_id'
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

            ->requirePresence('acronym', 'create')
            ->notEmpty('acronym')
            ->add('acronym', 'validFormat', [
                        'rule' => array('custom',  '/^[A-Za-záéíóúÁÉÍÓÚñÑ0-9" "\,\.\-\:\[\]\(\)\"]+$/'),
                        'message' => 'Formato inválido'
            ])

            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'validFormat', [
                        'rule' => array('custom',  '/^[A-Za-záéíóúÁÉÍÓÚñÑ0-9" "\,\.\-\:\[\]\(\)\"]+$/'),
                        'message' => 'Formato inválido'
            ])

            ->allowEmpty('location')
            ->add('location', 'validFormat', [
                        'rule' => array('custom',  '/^[A-Za-záéíóúÁÉÍÓÚñÑ0-9" "\,\.\-\:\[\]\(\)\"]+$/'),
                        'message' => 'Formato inválido'
            ])

            ->allowEmpty('schedule')
            ->add('schedule', 'validFormat', [
                        'rule' => array('custom',  '/^[A-Za-záéíóúÁÉÍÓÚñÑ0-9" "\,\.\-\:\[\]\(\)\"]+$/'),
                        'message' => 'Formato inválido'
            ])

            ->integer('authorized_card')
            ->requirePresence('authorized_card', 'create')
            ->notEmpty('authorized_card')
            ->add('authorized_card', 'validFormat', [
                        'rule' => array('custom', '/^[0-1]$/'),
                        'message' => 'Formato inválido'
            ])

            ->integer('enable')
            ->requirePresence('enable', 'update')
            ->notEmpty('enable')
            ->add('authorized_card', 'validFormat', [
                        'rule' => array('custom', '/^[0-1]$/'),
                        'message' => 'Formato inválido'
            ]);

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
        $rules->add($rules->existsIn(['headquarter_id'], 'Headquarters'));
        return $rules;
    }
}
