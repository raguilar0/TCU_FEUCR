<?php
namespace App\Model\Table;

use App\Model\Entity\Tract;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Event\Event;
use ArrayObject;

/**
 * Tracts Model
 *
 * @property \Cake\ORM\Association\HasMany $Amounts
 * @property \Cake\ORM\Association\HasMany $Boxes
 * @property \Cake\ORM\Association\HasMany $InitialAmounts
 * @property \Cake\ORM\Association\HasMany $Invoices
 * @property \Cake\ORM\Association\HasMany $Warehouses
 */
class TractsTable extends Table
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

        $this->table('tracts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Amounts', [
            'foreignKey' => 'tract_id'
        ]);
        $this->hasMany('Boxes', [
            'foreignKey' => 'tract_id'
        ]);
        $this->hasMany('InitialAmounts', [
            'foreignKey' => 'tract_id'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'tract_id'
        ]);
        $this->hasMany('Warehouses', [
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('number')
            ->requirePresence('number', 'create')
            ->notEmpty('number')
            ->add('number', 'validFormat', [
                'rule' => array('custom', '/^[1-4]$/'),
                'message' => 'Solo números entre 1 y 4'
            ]);

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->date('deadline')
            ->requirePresence('deadline', 'create')
            ->notEmpty('deadline');

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

}
