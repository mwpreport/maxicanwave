<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TravelExpenses Model
 *
 * @property \App\Model\Table\ExpensesTable|\Cake\ORM\Association\BelongsTo $Expenses
 *
 * @method \App\Model\Entity\TravelExpense get($primaryKey, $options = [])
 * @method \App\Model\Entity\TravelExpense newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TravelExpense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TravelExpense|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TravelExpense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TravelExpense[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TravelExpense findOrCreate($search, callable $callback = null, $options = [])
 */
class TravelExpensesTable extends Table
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

        $this->setTable('travel_expenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Expenses', [
            'foreignKey' => 'expense_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('workTypes', [
            'foreignKey' => 'work_type_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('CitiesFrom', [
            'foreignKey' => 'city_from',
            'joinType' => 'INNER',
            'className' => 'Cities'
        ]);

        $this->belongsTo('CitiesTo', [
            'foreignKey' => 'city_to',
            'joinType' => 'INNER',
            'className' => 'Cities'
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
            ->integer('city_from')
            ->requirePresence('city_from', 'create')
            ->notEmpty('city_from');

        $validator
            ->integer('city_to')
            ->requirePresence('city_to', 'create')
            ->notEmpty('city_to');

        $validator
            ->integer('km')
            ->requirePresence('km', 'create')
            ->notEmpty('km');

        $validator
            ->integer('fare')
            ->requirePresence('fare', 'create')
            ->notEmpty('fare');

        $validator
            ->scalar('travel_mode')
            ->requirePresence('travel_mode', 'create')
            ->notEmpty('travel_mode');
        

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
        $rules->add($rules->existsIn(['expense_id'], 'Expenses'));

        return $rules;
    }
}
